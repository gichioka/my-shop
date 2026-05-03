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

        // Stripe設定
        Stripe::setApiKey(config('services.stripe.secret'));

        // Stripeの明細を作成
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

        // StripeのCheckoutセッション作成
        $stripeSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'success_url'          => url('/payment/success'),
            'cancel_url'           => url('/checkout'),
        ]);

        // Stripeの決済ページへリダイレクト
        $this->redirect($stripeSession->url);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}