<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;

class ProductManager extends Component
{
    public $products = [];

    public $name = '';
    public $price = '';
    public $stock = '';

    public $editId = null;
    public $editName = '';
    public $editPrice = '';
    public $editStock = '';

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::latest()->get()->toArray();
    }

    public function addProduct()
    {
        $this->validate([
            'name'  => 'required',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'name'  => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);

        $this->name  = '';
        $this->price = '';
        $this->stock = '';

        $this->loadProducts();
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        $this->editId    = $id;
        $this->editName  = $product->name;
        $this->editPrice = $product->price;
        $this->editStock = $product->stock;
    }

    public function updateProduct()
    {
        $this->validate([
            'editName'  => 'required',
            'editPrice' => 'required|integer|min:1',
            'editStock' => 'required|integer|min:0',
        ]);

        Product::find($this->editId)->update([
            'name'  => $this->editName,
            'price' => $this->editPrice,
            'stock' => $this->editStock,
        ]);

        $this->editId    = null;
        $this->editName  = '';
        $this->editPrice = '';
        $this->editStock = '';

        $this->loadProducts();
    }

    public function cancelEdit()
    {
        $this->editId    = null;
        $this->editName  = '';
        $this->editPrice = '';
        $this->editStock = '';
    }

    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.admin.product-manager');
    }
}