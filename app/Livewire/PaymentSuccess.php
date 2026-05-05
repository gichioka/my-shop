<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\OrderConfirmation;

class PaymentSuccess extends Component
{
    public function mount()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            $this->redirect('/');
            return;
        }

        try {
            $order = DB::transaction(function () use ($cart) {

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

                    \App\Models\Product::findOrFail($item['id'])
                        ->decrement('stock', $item['quantity']);
                }

                session()->forget('cart');

                return $order;
            });

            Mail::to(auth()->user()->email)->send(new OrderConfirmation($order));

            $this->redirect('/orders');

        } catch (\Exception $e) {
            $this->redirect('/cart');
        }
    }

    public function render()
    {
        return view('livewire.payment-success');
    }
}