<!-- Modal -->

<div class="modal fade" id="transaksi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Stock</td>
                            <td>Harga</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->kode_barang }}</td>
                                <td>{{ $value->nama_barang }}</td>
                                <td>{{ $value->stock }}</td>
                                <td>{{ $value->harga }}</td>
                                <td>
                                    <form action="/add_to_cart/{{ $value->id }}" method="GET">
                                        <button type="submit" class="btn btn-primary">
                                            Pilih
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
