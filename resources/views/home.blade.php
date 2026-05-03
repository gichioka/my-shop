@extends('layouts.app')

@section('content')

<h1>🛍 商品一覧</h1>

@livewire('shopping-cart', ['mode' => 'shop'])

<a href="/cart" class="btn btn-success mt-3">
    カートへ
</a>

@endsection