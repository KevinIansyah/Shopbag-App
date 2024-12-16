<?php

namespace App\Http\Controllers;

use App\Helpers\SendNotificationHelpers;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutHomeController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.images', 'stock.size'])->where('user_id', Auth::id())->get();

        $totalPrice = $carts->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $totalWeight = $carts->sum(function ($item) {
            return $item->product->weight * $item->quantity;
        });

        $totalQuantity = $carts->sum('quantity');

        $address = Address::where('user_id', Auth::id())
            ->where('is_primary', true)
            ->first();

        if (!$address) {
            $address = Address::where('user_id', Auth::id())->first();
        }

        return view('checkout.index', compact('carts', 'totalPrice', 'totalWeight', 'totalQuantity', 'address'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'address_id' => 'required|exists:addresses,id',
            ]);

            $carts = Cart::with(['product'])->where('user_id', Auth::id())->get();

            $totalPrice = $carts->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'address_id' => $request->address_id,
                'midtrans_order_id' => uniqid('SHOPBAG_'),
                'expired_at' => now()->addMinutes(30),
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'stock_id' => $cart->stock_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

                $stock = Stock::find($cart->stock_id);
                $stock->quantity -= $cart->quantity;
                $stock->save();
            }

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->midtrans_order_id,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $order->snap_token = $snapToken;
            $order->save();

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return response()->json(['snapToken' => $snapToken, 'orderId' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Payment processing failed: ' . $e->getMessage()], 500);
        }
    }

    public function update($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'paid';
            $order->save();

            $orderItems = OrderItem::where('order_id', $order->id)->get();

            foreach ($orderItems as $orderItem) {
                $product = Product::find($orderItem->product_id);
                if ($product) {
                    $product->sold += $orderItem->quantity;
                    $product->save();
                }
            }

            $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail($id);
            $user = User::where('id', $order->user_id)->first();
            $admins = User::where('access', 'admin')->get();

            if ($user) {
                SendNotificationHelpers::sendOrderNotification($order, $user);
            }

            foreach ($admins as $admin) {
                SendNotificationHelpers::sendOrderNotification($order, $admin);
            }

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
