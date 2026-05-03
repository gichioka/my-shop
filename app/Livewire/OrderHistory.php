<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderHistory extends Component
{
    public $orders = [];

    public function mount()
    {
        $this->orders = Order::with(['items', 'user'])
                             ->latest()
                             ->get()
                             ->toArray();
    }

    public function render()
    {
        return view('livewire.order-history');
    }
}