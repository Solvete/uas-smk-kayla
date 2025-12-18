<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kategori Pembayaran</h5>
                
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <button wire:click="openModal" class="btn btn-primary mb-3">Tambah Kategori</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $cat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>Rp {{ number_format($cat->price, 0, ',', '.') }}</td>
                                <td>
                                    <button wire:click="edit({{ $cat->id }})" class="btn btn-success btn-sm">Edit</button>
                                    <button wire:click="delete({{ $cat->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Modal Tambah/Edit --}}
                @if($isModalOpen)
                <div class="modal fade show d-block" tabindex="-1" style="background-color:rgba(0,0,0,0.5)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $category_id ? 'Edit Kategori' : 'Tambah Kategori' }}</h5>
                                <button type="button" wire:click="closeModal" class="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Kategori</label>
                                    <input type="text" wire:model="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Harga</label>
                                    <input type="number" wire:model="price" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button wire:click="closeModal" class="btn btn-secondary">Batal</button>
                                <button wire:click="store" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>