<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShoppingCart extends Component
{
    public $cart = [];
    public $products = [];
    public $mode = 'shop';

    public function mount($mode = 'shop')
    {
        $this->mode = $mode;
        $this->products = Product::all()->keyBy('id')->toArray();
        $this->cart = session('cart', []);
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        // 在庫チェック
        $currentQty = isset($this->cart[$id]) ? $this->cart[$id]['quantity'] : 0;
        if ($currentQty >= $product->stock) {
            session()->flash('error', '在庫が足りません');
            return;
        }

        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity']++;
        } else {
            $this->cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
            ];
        }

        session(['cart' => $this->cart]);
        $this->dispatch('cartUpdated');
    }

    public function increase($id)
    {
        $product = Product::find($id);

        // 在庫チェック
        if ($this->cart[$id]['quantity'] >= $product->stock) {
            session()->flash('error', '在庫が足りません');
            return;
        }

        $this->cart[$id]['quantity']++;
        session(['cart' => $this->cart]);
        $this->dispatch('cartUpdated');
    }

    public function decrease($id)
    {
        if ($this->cart[$id]['quantity'] > 1) {
            $this->cart[$id]['quantity']--;
        } else {
            unset($this->cart[$id]);
        }

        session(['cart' => $this->cart]);
        $this->dispatch('cartUpdated');
    }

    public function clearCart()
    {
        $this->cart = [];
        session(['cart' => []]);
        $this->dispatch('cartUpdated');
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(
            fn($i) => $i['price'] * $i['quantity']
        );
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}