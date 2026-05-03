<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\OrderConfirmation;

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

// 決済完了
Route::get('/payment/success', function () {
    $cart = session('cart', []);

    if (!empty($cart)) {
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
        ]);

        foreach ($cart as $item) {
            $order->items()->create([
                'name'     => $item['name'],
                'price'    => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            \App\Models\Product::find($item['id'])->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        // メール送信
        Mail::to(auth()->user()->email)->send(new OrderConfirmation($order));
    }

    return redirect('/orders');
})->middleware('auth');

require __DIR__.'/auth.php';