<div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">名前</label>
                <input type="text"
                    wire:model="name"
                    class="form-control">
                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">住所</label>
                <input type="text"
                    wire:model="address"
                    class="form-control"
                    placeholder="例：東京都渋谷区...">
                @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <button wire:click="save" class="btn btn-primary">
                保存
            </button>

        </div>
    </div>

</div>