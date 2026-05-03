<div>

    {{-- 商品追加フォーム --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header">➕ 商品追加</div>
        <div class="card-body">

            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text"
                        wire:model="name"
                        class="form-control"
                        placeholder="商品名">
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-3">
                    <input type="number"
                        wire:model="price"
                        class="form-control"
                        placeholder="価格">
                    @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-3">
                    <input type="number"
                        wire:model="stock"
                        class="form-control"
                        placeholder="在庫数">
                    @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-2">
                    <button wire:click="addProduct" class="btn btn-primary w-100">
                        追加
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- 商品一覧 --}}
    <div class="card shadow-sm">
        <div class="card-header">📦 商品一覧</div>
        <div class="card-body p-0">

            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td>{{ $p['id'] }}</td>

                        @if($editId === $p['id'])
                            <td>
                                <input type="text"
                                    wire:model="editName"
                                    class="form-control form-control-sm">
                                @error('editName') <span class="text-danger small">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="number"
                                    wire:model="editPrice"
                                    class="form-control form-control-sm">
                                @error('editPrice') <span class="text-danger small">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="number"
                                    wire:model="editStock"
                                    class="form-control form-control-sm">
                                @error('editStock') <span class="text-danger small">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <button wire:click="updateProduct" class="btn btn-success btn-sm">保存</button>
                                <button wire:click="cancelEdit" class="btn btn-secondary btn-sm">キャンセル</button>
                            </td>
                        @else
                            <td>{{ $p['name'] }}</td>
                            <td>¥{{ number_format($p['price']) }}</td>
                            <td>{{ $p['stock'] }}個</td>
                            <td>
                                <button wire:click="editProduct({{ $p['id'] }})" class="btn btn-warning btn-sm">編集</button>
                                <button wire:click="deleteProduct({{ $p['id'] }})"
                                    wire:confirm="本当に削除しますか？"
                                    class="btn btn-danger btn-sm">削除</button>
                            </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>