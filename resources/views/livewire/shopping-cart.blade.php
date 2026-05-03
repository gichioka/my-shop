<div>

{{-- エラーメッセージ --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- 商品一覧 --}}
@if($mode === 'shop')

    <div class="row">
        @foreach($products as $p)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title">{{ $p['name'] }}</h5>

                        <p class="text-muted mb-1">
                            ¥{{ number_format($p['price']) }}
                        </p>

                        <p class="mb-3">
                            @if($p['stock'] > 0)
                                <span class="text-success small">在庫：{{ $p['stock'] }}個</span>
                            @else
                                <span class="text-danger small">在庫切れ</span>
                            @endif
                        </p>

                        @if($p['stock'] > 0)
                            <button
                                wire:click="addToCart({{ $p['id'] }})"
                                class="btn btn-primary mt-auto"
                            >
                                🛒 カートに追加
                            </button>
                        @else
                            <button class="btn btn-secondary mt-auto" disabled>
                                在庫切れ
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endif


{{-- カート --}}
@if($mode === 'cart')

    <div class="card shadow-sm">
        <div class="card-body">

            @if(empty($cart))
                <p class="text-center text-muted">カートは空です</p>
            @else

                @foreach($cart as $item)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <div>
                            <strong>{{ $item['name'] }}</strong>
                        </div>

                        <div class="d-flex align-items-center">
                            <button wire:click="decrease({{ $item['id'] }})"
                                class="btn btn-outline-secondary btn-sm">−</button>

                            <span class="mx-3">{{ $item['quantity'] }}</span>

                            <button wire:click="increase({{ $item['id'] }})"
                                class="btn btn-outline-secondary btn-sm">＋</button>
                        </div>

                        <div>
                            ¥{{ number_format($item['price'] * $item['quantity']) }}
                        </div>

                    </div>
                @endforeach

                <div class="text-end mt-4">
                    <h4>合計：¥{{ number_format($this->total) }}</h4>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button wire:click="clearCart" class="btn btn-outline-danger">
                        🗑 全削除
                    </button>
                </div>

            @endif

        </div>
    </div>

@endif

</div>