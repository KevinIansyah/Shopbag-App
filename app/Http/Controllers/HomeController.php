<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['images'])->get();

        return view('index', compact('products'));
    }

    public function detailProduct($slug)
    {
        // Ambil product data
        $product = Product::with(['images'])->where('slug', $slug)->firstOrFail();

        $stocks = Stock::with(['size'])->where('product_id', $product->id)->get();
        // $stocks = Stock::with('size')->get()->map(function ($stock) {
        //     return [
        //         'size_id' => $stock->size_id,
        //         'quantity' => $stock->quantity,
        //         'size_name' => $stock->size->name,
        //     ];
        // });

        // Ambil semua order items yang terkait dengan product_id
        $orderItems = OrderItem::with('reviews')
            ->where('product_id', $product->id)
            ->get();

        // Ambil semua reviews
        $reviews = $orderItems->flatMap(function ($item) {
            return $item->reviews;
        });

        // return dd($stocks);

        return view('product.index', compact('product', 'stocks'));
    }

    public function storeCart($id, Request $request)
    {
        try {
            // return dd($request);

            $request->validate([
                'stock_id' => 'required|integer',
                'quantity' => 'required|integer',
            ]);

            Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'stock_id' => $request->stock_id,
                ],
                [
                    'quantity' => $request->quantity,
                ]
            );

            return redirect()->back()->with('success_sweet', 'Success added to cart.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_sweet', $e->getMessage());
        }
    }
}
