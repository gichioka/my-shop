@extends('layouts.app')

@section('content')

<h1>🧾 注文確認</h1>

@livewire('checkout')

<a href="/cart" class="btn btn-secondary mt-3">
    カートに戻る
</a>

@endsection