<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class Checkout extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = session('cart', []);

        // 住所が未登録の場合はプロフィールページへ
        if (empty(auth()->user()->address)) {
            $this->redirect('/profile');
            return;
        }
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(
            fn($i) => $i['price'] * $i['quantity']
        );
    }

    public function placeOrder()
    {
        if (empty($this->cart)) {
            return;
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($this->cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'jpy',
                    'unit_amount'  => $item['price'],
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $stripeSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'success_url'          => url('/payment/success'),
            'cancel_url'           => url('/checkout'),
            'metadata'             => [
                'user_id' => auth()->id(),
            ],
        ]);

        $this->redirect($stripeSession->url);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}