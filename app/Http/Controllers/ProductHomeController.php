<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductHomeController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['images'])->where('slug', $slug)->firstOrFail();

        $stocks = Stock::with(['size'])->where('product_id', $product->id)->get();

        $orderItems = OrderItem::with('reviews')
            ->where('product_id', $product->id)
            ->get();

        $reviews = $orderItems->flatMap(function ($item) {
            return $item->reviews;
        });

        return view('product.index', compact('product', 'stocks'));
    }
}
