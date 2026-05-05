<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout')->middleware('auth');
Route::view('/dashboard', 'dashboard')->name('dashboard');

// プロフィール
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

// 管理者のみ
Route::get('/orders', function () {
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403);
    }
    return view('orders');
});

Route::get('/admin/products', function () {
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403);
    }
    return view('admin.products');
});

Route::get('/admin/users', function () {
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403);
    }
    return view('admin.users');
});

Route::view('/payment/success', 'payment-success')->middleware('auth');

require __DIR__.'/auth.php';