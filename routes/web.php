<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RajaOngkir;
use App\Models\Product;
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
        Route::get('/data', [ProductController::class, 'data'])->name('data');
        route::post('/image', [ProductController::class, 'uploadImage'])->name('image');
        Route::post('/upload-file', [FilepondController::class, 'uploadFile'])->name('upload-file');
        Route::delete('/cancel-file', [FilepondController::class, 'cancelFile'])->name('cancel-file');
        Route::delete('/remove-file', [FilepondController::class, 'removeFile'])->name('remove-file');
        Route::post('/upload-file-multiple', [FilepondController::class, 'uploadFileMultiple'])->name('upload-file-multiple');
        Route::delete('/cancel-file-multiple', [FilepondController::class, 'cancelFileMultiple'])->name('cancel-file-multiple');
        Route::delete('/remove-file-multiple', [FilepondController::class, 'removeFileMultiple'])->name('remove-file-multiple');

        Route::name('category.')->prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/data', [CategoryController::class, 'data'])->name('data');
        });
        Route::resource('category', CategoryController::class);
    });
    Route::resource('product', ProductController::class);
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
