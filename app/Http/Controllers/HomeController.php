<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

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
        // $orderItems = OrderItem::with('reviews')
        //     ->where('product_id', $product->id)
        //     ->get();

        // Ambil semua reviews
        $reviews = $orderItems->flatMap(function ($item) {
            return $item->reviews;
        });

        // return dd($stocks);

        return view('product.index', compact('product', 'stocks'));
    }
}
