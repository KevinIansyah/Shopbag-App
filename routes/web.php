<?php

use App\Http\Controllers\AddressHomeController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SaleController;

use App\Http\Controllers\BlogHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartHomeController;
use App\Http\Controllers\CheckoutHomeController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\ProductHomeController;
use App\Http\Controllers\ProfileHomeController;
use App\Http\Controllers\OrderHomeController;

use App\Http\Controllers\RajaOngkir;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\FilepondController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

use App\Mail\ConfirmationPayment;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    $user = User::findOrFail(1);
    $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail(5);
    $message_mail = [
        'open_message' => 'Your payment was successful and is awaiting further confirmation. Here are your order details:',
        'close_message' => 'Thank you for shopping at Shopbag. We will process your order shortly and notify you about its status.',
        'link' => env('APP_URL') . '/profile?p=transaction-list',
    ];

    $data = [
        'message' => $message_mail,
        'subject' => 'Your Payment Was Successful',
        'order' => $order,
        'user' => $user,
    ];

    Mail::to($user->email)->queue(new OrderMail($data));
    return 'Email sent!';
});

Route::get('/order-mail', function () {
    $user = User::findOrFail(1);
    $order = Order::with(['orderItems.product', 'orderItems.stock.size', 'address'])->findOrFail(5);
    $message_mail = [
        'subject' => 'Your Payment Was Successful',
        'open_message' => 'Your payment was successful and is awaiting further confirmation. Here are your order details:',
        'close_message' => 'Thank you for shopping at Shopbag. We will process your order shortly and notify you about its status.',
        'link' => env('APP_URL') . '/profile?p=transaction-list',
    ];

    return view('mail.order-mail', compact('user', 'order', 'message_mail'));
});

Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');;
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])->name('auth.google.callback');

Route::post('/upload-image', [FilepondController::class, 'uploadImage'])->name('upload-image');
Route::delete('/cancel-image', [FilepondController::class, 'cancelImage'])->name('cancel-image');
Route::post('/upload-image-multiple', [FilepondController::class, 'uploadImageMultiple'])->name('upload-image-multiple');
Route::delete('/cancel-image-multiple', [FilepondController::class, 'cancelImageMultiple'])->name('cancel-image-multiple');

Route::get('/', [HomeController::class, 'index']);
Route::resource('product', ProductHomeController::class);
Route::resource('cart', CartHomeController::class)->middleware(['auth']);
Route::resource('checkout', CheckoutHomeController::class)->middleware(['auth']);
Route::resource('address', AddressHomeController::class)->middleware(['auth']);
Route::resource('blog', BlogHomeController::class);
Route::name('order.')->prefix('order')->middleware(['auth'])->group(function () {
    Route::post('/accept/{id}', [OrderHomeController::class, 'acceptDelivered'])->name('accept');
    Route::post('/cancel/{id}', [OrderHomeController::class, 'cancelOrder'])->name('cancel');
    Route::get('/pay/{id}', [OrderHomeController::class, 'payOrder'])->name('pay');
    Route::post('/review', [OrderHomeController::class, 'reviewOrder'])->name('review');
});

Route::name('profile.')->prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfileHomeController::class, 'index'])->name('index');
    Route::post('/', [ProfileHomeController::class, 'store'])->name('store');
    Route::put('/', [ProfileHomeController::class, 'update'])->name('update');
    Route::delete('/', [ProfileHomeController::class, 'destroy'])->name('destroy');
    Route::delete('/remove-image', [FilepondController::class, 'removeImageProfile'])->name('remove-image');
    Route::get('/api/cities', [RajaOngkir::class, 'getCities']);
});

Route::name('dashboard.')->prefix('dashboard')->middleware(['auth', 'verified', 'isadmin'])->group(function () {
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
        Route::delete('/remove-image-multiple', [FilepondController::class, 'removeImageMultiple'])->name('remove-image-multiple');

        Route::name('category.')->prefix('category')->group(function () {
            Route::get('/data', [CategoryController::class, 'data'])->name('data');
        });
        Route::resource('category', CategoryController::class);
    });
    Route::resource('product', ProductController::class);

    Route::name('sale.')->prefix('sale')->group(function () {
        Route::get('/data', [SaleController::class, 'data'])->name('data');
    });
    Route::resource('sale', SaleController::class);

    Route::name('report')->prefix('report')->group(function () {});
    Route::resource('report', ReportController::class);
});

require __DIR__ . '/auth.php';
