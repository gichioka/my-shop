<div>

@if(empty($orders))
    <p class="text-muted">注文履歴がありません</p>
@else

    @foreach($orders as $order)
        <div class="card mb-4 shadow-sm">

            <div class="card-header d-flex justify-content-between">
                <span>注文 #{{ $order['id'] }}</span>
                <span class="text-muted">{{ $order['created_at'] }}</span>
            </div>

            <div class="card-body">

                {{-- ユーザー情報 --}}
                <div class="mb-3 p-2 bg-light rounded">
                    <div><strong>👤 名前：</strong>{{ $order['user']['name'] ?? 'ゲスト' }}</div>
                    <div><strong>📍 住所：</strong>{{ $order['user']['address'] ?? '未登録' }}</div>
                </div>

                {{-- 注文明細 --}}
                @foreach($order['items'] as $item)
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span>¥{{ number_format($item['price'] * $item['quantity']) }}</span>
                    </div>
                @endforeach

                <div class="text-end mt-3">
                    <strong>合計：¥{{ number_format($order['total']) }}</strong>
                </div>

            </div>

        </div>
    @endforeach

@endif

<a href="/" class="btn btn-secondary mt-2">トップへ戻る</a>

</div>