<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.navbar', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $cartCount = Cart::where('user_id', $userId)->count();
            } else {
                $cartCount = 0;
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
