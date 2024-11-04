<!-- Modal -->
<div class="modal fade" id="editbarang{{ $value->id }}" tabindex="-1" aria-labelledby="editbarang" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/update_barang/{{ $value->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editbarang">Edit Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ $value->kode_barang }}" id="kode_barang"
                            class="form-control" placeholder="Input Kode Barang">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ $value->nama_barang }}" id="nama_barang"
                            class="form-control" placeholder="Input Nama Barang">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="{{ $value->kategori->id }}">{{ $value->kategori->nama_kategori }}</option>
                            @foreach ($kategori as $list)
                                <option value="{{ $list->id }}">{{ $list->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" value="{{ $value->gambar }}" id="gambar"
                            class="form-control" placeholder="Input Gambar">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" name="stock" id="stock" class="form-control"
                            value="{{ $value->stock }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" name="harga" value="{{ $value->harga }}" id="harga"
                            class="form-control" placeholder="Input Harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
