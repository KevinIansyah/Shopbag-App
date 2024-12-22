<?php

namespace App\Http\Controllers;

use App\Helpers\SendNotificationHelpers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\Stock;
use App\Models\TemporaryImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderHomeController extends Controller
{
    public function acceptDelivered($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'completed';
            $order->save();

            return redirect()->back()->with('success', 'Order has been marked as delivered.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the order status.');
        }
    }

    public function cancelOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'canceled';
            $order->save();

            $orderItems = OrderItem::where('order_id', $id)->get();

            foreach ($orderItems as $item) {
                $stock = Stock::find($item->stock_id);
                $stock->quantity += $item->quantity;
                $stock->save();
            }

            $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail($id);
            $user = User::where('id', $order->user_id)->first();

            if ($user) {
                SendNotificationHelpers::sendOrderNotification($order, $user);
            }

            return redirect()->back()->with('success', 'Order has been canceled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the order status.');
        }
    }

    public function expiredOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'canceled';
            $order->save();

            $orderItems = OrderItem::where('order_id', $id)->get();

            foreach ($orderItems as $item) {
                $stock = Stock::find($item->stock_id);
                $stock->quantity += $item->quantity;
                $stock->save();
            }

            $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail($id);
            $user = User::where('id', $order->user_id)->first();
            $sendNotification = 'system';

            if ($user) {
                SendNotificationHelpers::sendOrderNotification($order, $user, $sendNotification);
            }

            return redirect()->back()->with('success', 'Order has been automatically canceled due to expiration.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to automatically cancel the order due to expiration. Please try again later.');
        }
    }

    public function payOrder($id)
    {
        try {
            $order = Order::findOrFail($id);

            return response()->json(['snapToken' => $order->snap_token, 'orderId' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment processing failed: ' . $e->getMessage()], 500);
        }
    }

    public function reviewOrder(Request $request)
    {
        try {
            $sessionImageMultiple = Session::get('image-multiple-filepond');

            $validateData = $request->validate([
                'order_id' => 'required|integer',
                'rating' => 'required|integer',
                'comment' => 'required|string',
            ]);

            $orderItems = OrderItem::where('order_id', $validateData['order_id'])->get();
            $processedProducts = [];

            foreach ($orderItems as $orderItem) {
                $product = Product::find($orderItem->product_id);

                if ($product && !in_array($product->id, $processedProducts)) {
                    $reviews = Review::whereHas('order', function ($query) use ($product) {
                        $query->whereHas('orderItems', function ($query) use ($product) {
                            $query->where('product_id', $product->id);
                        });
                    })->get();

                    $totalReviewsOld = $reviews->count() > 0 ? $reviews->count() : 0;
                    $avgRatingOld = $reviews->count() > 0 ? $reviews->avg('rating') : 0;

                    $avgRating = (($avgRatingOld * $totalReviewsOld) + $validateData['rating']) / ($totalReviewsOld + 1);

                    $product->avg_rating = $avgRating;
                    $product->save();

                    $processedProducts[] = $product->id;
                }
            }

            $validateData['user_id'] = Auth::id();
            $review = Review::create($validateData);

            Order::where('id', $validateData['order_id'])
                ->update(['is_review' => true]);

            if (!empty($sessionImageMultiple)) {
                if ($tmpFileMultiples = TemporaryImage::whereIn('folder', $sessionImageMultiple)->get()) {
                    $this->handleTemporaryImages($tmpFileMultiples, $review->id);
                    Session::forget('image-multiple-filepond');
                }
            }

            return redirect()->back()->with('success', 'Review has been added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add the review. Please try again.');
        }
    }

    private function handleTemporaryImages($tmpFileMultiples, $reviewId)
    {
        foreach ($tmpFileMultiples as $tmpFileMultiple) {
            Storage::disk('public')->move(
                'post/tmp-image-filepond/' . $tmpFileMultiple->folder . '/' . $tmpFileMultiple->file,
                'image-filepond/' . $tmpFileMultiple->folder . '/' . $tmpFileMultiple->file
            );

            ReviewImage::create([
                'review_id' => $reviewId,
                'image_url' => $tmpFileMultiple->folder . '/' . $tmpFileMultiple->file,
            ]);

            Storage::disk('public')->deleteDirectory('post/tmp-image-filepond/' . $tmpFileMultiple->folder);
            $tmpFileMultiple->delete();
        }
    }
}
