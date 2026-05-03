<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserManager extends Component
{
    public $users = [];

    public function mount()
    {
        $this->users = User::withCount('orders')->latest()->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.user-manager');
    }
}