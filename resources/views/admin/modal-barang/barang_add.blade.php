<!-- Modal -->
<div class="modal fade" id="tambahbarang" tabindex="-1" aria-labelledby="tambahbarang" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/tambah_barang" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ $kodeBarang }}" id="kode_barang"
                            class="form-control" placeholder="Input Kode Barang">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                            placeholder="Input Nama Barang">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <section>
                            <select name="kategori_id" id="kategori_id" class="form-select">
                                <option value="">-- PILIH KATEGORI --</option>
                                @foreach ($kategori as $value)
                                    <option value="{{ $value->id }}">{{ $value->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </section>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control"
                            placeholder="Input Gambar">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" name="stock" id="stock" class="form-control"
                            placeholder="Input Stock">
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control"
                            placeholder="Input Harga">
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
