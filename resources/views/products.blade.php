<div class="products">
    @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>¥{{ number_format($product->price) }}</p>
            <livewire:shopping-cart />
            @livewire('shopping-cart')
            <button wire:click="$dispatch('addToCart', { productId: {{ $product->id }} })">
                カートに追加
            </button>
        </div>
    @endforeach
</div>