<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorProductController;
use App\Http\Controllers\VendorOrderController;
use App\Http\Controllers\DeliveryBoyController;
use App\Http\Controllers\DeliveryAssignmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerLocationController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ForgotPasswordController;

//Public Routes

        Route::get('/debug-products', function () {
    return \App\Models\Product::orderBy('id')
        ->get(['id', 'name', 'image']);
});

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/category/{category:slug}', [HomeController::class, 'category'])
        ->name('category');

    

//Product Details

    Route::get('/product/{product:slug}', [HomeController::class, 'product'])
        ->name('product.show');


//Authentication

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', [
        'token' => $token,
    ]);
})
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');
//Customer Routes

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::post('/customer/location', [CustomerLocationController::class, 'store'])
        ->name('customer.location.store');

// Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::get('/checkout/delivery-charge', [CheckoutController::class, 'deliveryCharge'])
        ->name('checkout.delivery-charge');

    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.place-order');

// Address
    Route::post('/address/store', [AddressController::class, 'store'])
        ->name('address.store');

// Orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/orders/{order}/tracking/location', [OrderTrackingController::class, 'location'])
        ->name('orders.tracking.location');
});

//Vendor Routes

Route::middleware(['auth', 'role:vendor'])->group(function () {

    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])
        ->name('vendor.dashboard');

    // Products
    Route::get('/vendor/products/create', [ProductController::class, 'create'])
        ->name('vendor.products.create');

    Route::post('/vendor/products', [ProductController::class, 'store'])
        ->name('vendor.products.store');

    Route::get('/vendor/products/{product}/edit', [VendorProductController::class, 'edit'])
        ->name('vendor.products.edit');

    Route::put('/vendor/products/{product}', [VendorProductController::class, 'update'])
        ->name('vendor.products.update');

    Route::delete('/vendor/products/{product}', [VendorProductController::class, 'destroy'])
        ->name('vendor.products.destroy');

    // Orders
    Route::get('/vendor/orders', [VendorOrderController::class, 'index'])
        ->name('vendor.orders.index');

    Route::put('/vendor/orders/{order}/status', [VendorOrderController::class, 'updateStatus'])
        ->name('vendor.orders.update-status');

    // Delivery Assignment
    Route::get('/vendor/orders/{order}/assign', [DeliveryAssignmentController::class, 'create'])
        ->name('vendor.orders.assign');

    Route::post('/vendor/orders/{order}/assign', [DeliveryAssignmentController::class, 'store'])
        ->name('vendor.orders.assign.store');

    Route::get('/vendor/location', [VendorController::class, 'location'])
        ->name('vendor.location');

    Route::put('/vendor/location', [VendorController::class, 'updateLocation'])
        ->name('vendor.location.update');
});

// Delivery Boy Routes

Route::middleware(['auth', 'role:delivery_boy'])->group(function () {

    Route::get('/delivery-boy/dashboard', [DeliveryBoyController::class, 'dashboard'])
        ->name('delivery-boy.dashboard');

    Route::put('/delivery-boy/orders/{assignment}/status', [DeliveryBoyController::class, 'updateStatus'])
        ->name('delivery-boy.orders.update-status');

    Route::put('/delivery-boy/orders/{assignment}/location', [DeliveryBoyController::class, 'updateLocation'])
        ->name('delivery-boy.orders.update-location');
});

//Admin Routes

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users.index');

    Route::get('/admin/vendors', [AdminController::class, 'vendors'])
        ->name('admin.vendors.index');

    Route::get('/admin/products', [AdminController::class, 'products'])
        ->name('admin.products.index');

    Route::get('/admin/orders', [AdminController::class, 'orders'])
        ->name('admin.orders.index');

    Route::get('/admin/delivery-assignments', [AdminController::class, 'deliveryAssignments'])
        ->name('admin.delivery-assignments.index');

    Route::get('/admin/orders/{order}', [AdminController::class, 'showOrder'])
        ->name('admin.orders.show');

    Route::put('/admin/vendors/{vendor}/toggle', [AdminController::class, 'toggleVendor'])
        ->name('admin.vendors.toggle');

    Route::put('/admin/products/{product}/toggle', [AdminController::class, 'toggleProduct'])
        ->name('admin.products.toggle');

    Route::put('/admin/products/{product}/availability', [AdminController::class, 'toggleProductAvailability'])
        ->name('admin.products.availability');
    
    Route::put('/admin/users/{user}/toggle',[AdminController::class, 'toggleUser'])
        ->name('admin.users.toggle');

});