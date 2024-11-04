<!-- Modal -->

<div class="modal fade" id="hapusbarang{{ $value->id }}" tabindex="-1" aria-labelledby="hapusbarang" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/barang_delete/{{ $value->id }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusbarang">Konfirmasi Hapus Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus Barang : <strong>{{ $value->nama_kategori }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
