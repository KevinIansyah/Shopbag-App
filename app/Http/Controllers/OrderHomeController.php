<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\Stock;
use App\Models\TemporaryImage;
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

        //     return response()->json(['success' => true, 'message' => 'Order has been marked as delivered.']);
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'message' => 'Failed to update the order status.']);
        // }
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

            return redirect()->back()->with('success', 'Order has been canceled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the order status.');
        }
        //     return response()->json(['success' => true, 'message' => 'Order has been canceled.']);
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'message' => 'Failed to update the order status.']);
        // }
    }

    public function reviewOrder(Request $request)
    {
        try {
            $sessionImageMultiple = Session::get('image-multiple-filepond');

            if (empty($sessionImageMultiple)) {
                throw new \Exception('Temporary files not found.');
            }

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

            if ($tmpFileMultiples = TemporaryImage::whereIn('folder', $sessionImageMultiple)->get()) {
                $this->handleTemporaryImages($tmpFileMultiples, $review->id);
                Session::forget('image-multiple-filepond');
            }

            return redirect()->back()->with('success', 'Review has been added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
            // return redirect()->back()->with('error', 'Failed to add the review. Please try again.');
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
