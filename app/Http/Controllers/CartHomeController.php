<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartHomeController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.images', 'stock.size'])->where('user_id', Auth::id())->get();
        $originalPrice = $carts->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $totalQuantity = $carts->sum('quantity');
        return view('cart.index', compact('carts', 'originalPrice', 'totalQuantity'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer',
                'stock_id' => 'required|integer',
                'quantity' => 'required|integer',
            ]);

            Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'stock_id' => $request->stock_id,
                ],
                [
                    'quantity' => $request->quantity,
                ]
            );

            return redirect()->back()->with('success', 'Item successfully added to cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add item to cart.');
        }
    }

    public function destroy($id)
    {
        try {
            $cart = Cart::findOrFail($id);

            $cart->delete();

            return redirect()->back()->with('success', 'Item successfully deleted from cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete item from cart.');
        }
    }
}
