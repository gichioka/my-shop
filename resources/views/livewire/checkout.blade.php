<div>

    @if(empty($cart))
        <p class="text-muted">カートが空です</p>
    @else

        @foreach($cart as $item)
            <div class="d-flex justify-content-between border-bottom py-2">
                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                <span>¥{{ number_format($item['price'] * $item['quantity']) }}</span>
            </div>
        @endforeach

        <div class="text-end mt-3">
            <h4>合計：¥{{ number_format($this->total) }}</h4>
        </div>

        <button wire:click="placeOrder" class="btn btn-success mt-2 w-100">
            💳 注文する
        </button>

    @endif

</div>