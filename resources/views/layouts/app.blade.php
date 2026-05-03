<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

    <title>My Shop</title>

    @livewireStyles

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a href="/" class="navbar-brand">🛍 My Shop</a>

    <div class="d-flex gap-2">

        @auth
            <a href="/profile" class="btn btn-outline-light">👤 プロフィール</a>

            @if(auth()->user()->is_admin)
                <a href="/orders" class="btn btn-outline-warning">📋 注文履歴</a>
                <a href="/admin/products" class="btn btn-outline-warning">⚙️ 商品管理</a>
                <a href="/admin/users" class="btn btn-outline-warning">👥 ユーザー管理</a>
            @endif

            <form action="/logout" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-outline-danger">ログアウト</button>
            </form>
        @else
            <a href="/login" class="btn btn-outline-light">ログイン</a>
            <a href="/register" class="btn btn-outline-light">会員登録</a>
        @endauth

        <a href="/cart" class="btn btn-outline-light">🛒 カート</a>

    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

@livewireScripts
</body>
</html>