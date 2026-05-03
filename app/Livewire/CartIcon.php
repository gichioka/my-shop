<?php

namespace App\Livewire;

use Livewire\Component;

class CartIcon extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'update'];

    public function mount()
    {
        $this->update();
    }

    public function update()
    {
        $this->count = collect(session('cart', []))->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}