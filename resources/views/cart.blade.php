@extends('layouts.app')

@section('content')

<h1>🛒 カート</h1>

@livewire('shopping-cart', ['mode' => 'cart'])

<a href="/checkout" class="btn btn-primary mt-3">
    注文へ進む
</a>

@endsection