<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RajaOngkir;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::name('dashboard.')->prefix('dashboard')->middleware(['isadmin', 'auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('index');

    Route::name('user.')->prefix('user')->group(function () {
        Route::name('admin.')->prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/data', [AdminController::class, 'data'])->name('data');
        });

        Route::name('client.')->prefix('client')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/data', [ClientController::class, 'data'])->name('data');
        });
    });

    Route::name('product.')->prefix('product')->group(function () {
        Route::name('category.')->prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/data', [CategoryController::class, 'data'])->name('data');
        });
        Route::resource('category', CategoryController::class);
    });
});

Route::name('profile.')->prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');

    Route::get('/api/cities', [RajaOngkir::class, 'getCities']);
});

Route::name('product.')->prefix('product')->group(function () {
    Route::get('/', function () {
        return view('product.index');
    })->name('index');
});

require __DIR__ . '/auth.php';
