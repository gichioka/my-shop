<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name = '';
    public $address = '';

    public function mount()
    {
        $this->name    = Auth::user()->name;
        $this->address = Auth::user()->address;
    }

    public function save()
    {
        $this->validate([
            'name'    => 'required',
            'address' => 'nullable|string|max:255',
        ]);

        Auth::user()->update([
            'name'    => $this->name,
            'address' => $this->address,
        ]);

        session()->flash('success', '保存しました！');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}