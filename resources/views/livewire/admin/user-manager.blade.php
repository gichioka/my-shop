<div>
    <table class="table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メール</th>
                <th>注文数</th>
                <th>登録日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['orders_count'] }}</td>
                <td>{{ $user['created_at'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>