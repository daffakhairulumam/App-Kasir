<!-- Modal -->

<div class="modal fade" id="hapustransaksi{{ $cart->id }}" tabindex="-1" aria-labelledby="hapustransaksi"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/keranjang/{{ $cart->id }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapuskategori">Konfirmasi Hapus Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus Barang : <strong>{{ $cart->nama_barang }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
