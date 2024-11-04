<!-- Modal -->

<div class="modal fade" id="editkategori{{ $value->id }}" tabindex="-1" aria-labelledby="editkategori"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/update_kategori/{{ $value->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editkategori">Edit Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" value="{{ $value->nama_kategori }}"
                            id="nama_kategori" class="form-control" placeholder="Input Nama Kategori">
                    </div>
                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" value="{{ $value->keterangan }}" id="keterangan"
                            class="form-control" placeholder="Input Keterangan">
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
