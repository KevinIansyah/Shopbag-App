<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductHomeController extends Controller
{
    public function index(Request $request)
    {
        // $categories = Category::all();

        // $selectedCategories = $request->input('categories', []);
        // $search = $request->input('search', '');

        // $products = Product::with(['images'])
        //     ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
        //         return $query->whereHas('categories', function ($query) use ($selectedCategories) {
        //             $query->whereIn('category_id', $selectedCategories);
        //         });
        //     })
        //     ->when(!empty($search), function ($query) use ($search) {
        //         return $query->where('name', 'like', '%' . $search . '%');
        //     })
        //     ->get();

        // if (!empty($selectedCategories)) {
        //     $products = $products->filter(function ($product) use ($selectedCategories) {
        //         $categoryIds = $product->categories->pluck('id')->toArray();
        //         return count(array_intersect($selectedCategories, $categoryIds)) === count($selectedCategories);
        //     });
        // }

        $categories = Category::all();

        $selectedCategories = $request->input('categories', []);
        $search = $request->input('search', '');

        $productsQuery = Product::with(['images', 'categories'])
            ->when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                foreach ($selectedCategories as $categoryId) {
                    $query->whereHas('categories', function ($query) use ($categoryId) {
                        $query->where('category_id', $categoryId);
                    });
                }
            })
            ->when(!empty($search), function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%');
            });

        // Untuk mendukung pagination
        $products = $productsQuery->paginate(10);

        return view('product.index', compact('categories', 'products'));
    }

    public function show($slug)
    {
        $product = Product::with(['images'])->where('slug', $slug)->firstOrFail();

        $stocks = Stock::with(['size'])->where('product_id', $product->id)->get();

        $reviews = Review::with('user', 'images')->whereHas('order', function ($query) use ($product) {
            $query->whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            });
        })->get();

        $totalReviews = $reviews->count() > 0 ? $reviews->count() : 0;
        $averageRating = $reviews->count() > 0 ? $reviews->avg('rating') : 0;

        $ratingBreakdown = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        return view('product.detail', compact('product', 'stocks', 'reviews', 'totalReviews', 'averageRating', 'ratingBreakdown'));
    }
}
