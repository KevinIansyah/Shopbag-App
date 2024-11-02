<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.images', 'stock.size'])->where('user_id', Auth::id())->get();
        $originalPrice = $carts->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $totalQuantity = $carts->sum('quantity');
        // return dd($carts);
        return view('cart.index', compact('carts', 'originalPrice', 'totalQuantity'));
    }
}
