<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<h2>ご注文ありがとうございます！</h2>

<p>注文番号：#{{ $order->id }}</p>

<h3>注文内容</h3>

@foreach($order->items as $item)
    <p>{{ $item->name }} × {{ $item->quantity }} ：¥{{ number_format($item->price * $item->quantity) }}</p>
@endforeach

<p><strong>合計：¥{{ number_format($order->total) }}</strong></p>

<hr>

<p>またのご利用をお待ちしております。</p>

</body>
</html>