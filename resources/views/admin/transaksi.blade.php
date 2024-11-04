@extends('layouts.mainLayout')

@section('title', 'Admin - Transaksi')

@section('content')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
    <h1>Transaksi</h1>

    <div class="text-end mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transaksi">
            Pilih Barang
        </button>
    </div>

    <div class="row mb-3">
        <div class="col-md-2">
            <h4 class="mb-0">Kode Transaksi</h4>
        </div>
        <div class="col-md-2">
            <h4 class="mb-0">: {{ $kodeTransaksi }}</h4>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-2">
            <h4 class="mb-0">Tanggal</h4>
        </div>
        <div class="col-md-10">
            <h4 class="mb-0">: {{ now()->format('d-m-Y') }}</h4>
        </div>
    </div>


    <br>
    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    @include('admin.modal-transaksi.add_cart')

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keranjang as $cart)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> <span class="badge bg-success">{{ $cart->kode_barang }}</span></td>
                    <td>{{ $cart->nama_barang }}</td>
                    <td>{{ $cart->harga }}</td>
                    <td>
                        <form action="{{ route('keranjang.update', $cart->id) }}" method="POST">
                            @csrf
                            <input type="number" name="qty" value="{{ $cart->qty }}" class="form-control"
                                min="1" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>{{ $cart->subtotal }}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#hapustransaksi{{ $cart->id }}">
                            <form action="{{ route('keranjang.destroy', $cart->id) }}" method="POST"">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </a>
                    </td>
                </tr>
                @include('admin.modal-transaksi.delete')
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('transaksi.simpan') }}" method="POST">
        @csrf

        <div class="row mt-3">
            <div class="col-md-2">
                <label for="bayar" class="form-label">Bayar</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="bayar" id="bayar" value="{{ number_format($total, 0, ',', '.') }}"
                    class="form-control" readonly>
                <input type="hidden" name="total" value="{{ $total }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2">
                <label for="diterima" class="form-label">Diterima</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="diterima" id="diterima" class="form-control"
                    placeholder="Masukan jumlah uang yang diterima">
                <div id="error-message" class="text-danger mt-2" style="display:none"></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2">
                <label for="kembali" class="form-label">Kembalian</label>
            </div>
            <div class="col-md-3">
                <input type="text" name="kembali" value="Rp. 0" id="kembali" class="form-control" readonly>
            </div>
        </div>

        {{-- Tombol Simpan Transaksi --}}
        <div class="row mt-3">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            </div>
        </div>
    </form>
    <script>
        // Fungsi untuk memformat angka menjadi mata uang Indonesia

        function formatCurrency(value) {

            // Menghilangkan karakter selain angka

            value = value.replace(/\D/g, '');
            return 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        document.getElementById('diterima').addEventListener('input', function() {

            // Ambil nilai dari input Bayar tanpa simbol

            var bayar = parseFloat(document.getElementById('bayar').value.replace(/Rp. /g, '').replace(/\./g, '')

                .trim());

            // Hapus simbol Rp. dan ambil angka saja

            var diterima = this.value.replace(/Rp\. /g, '').replace(/\D/g, '').trim();
            var errorMessage = document.getElementById('error-message');
            var kembaliField = document.getElementById('kembali');

            // Mengupdate nilai ditampilkan dalam format currency

            this.value = formatCurrency(diterima);

            errorMessage.style.display = "none";
            kembaliField.value = "Rp. 0";

            // Cek jika input 'diterima' kosong atau tidak valid
            if (isNaN(diterima) || diterima === "") {
                errorMessage.innerHTML = "Uang tidak boleh kosong";
                errorMessage.style.display = "block";
                return;
            }

            // Hitung kembali
            var kembali = parseFloat(diterima) - bayar;
            // Jika kembalian negatif, tampilkan pesan error dan set kembalian jadi Rp. 0
            if (kembali < 0) {
                errorMessage.innerHTML = "Uang tidak boleh kurang dari total bayar";
                errorMessage.style.display = "block";
                kembaliField.value = "Rp. 0";
                return;
            }
            // Jika tidak ada error, sembunyikan pesan error dan tampilkan kembalian
            errorMessage.style.display = "none";
            kembaliField.value = "Rp. " + kembali.toLocaleString('id-ID');
        });

        document.getElementById('bayar').addEventListener('input', function() {
            // Menambahkan format currency pada input bayar
            this.value = formatCurrency(this.value);
        });
    </script>
@endsection
{{--
<script>
    document.getElementById('diterima').addEventListener('input',
        function() {
            var bayar = perseFloat(document.getElementById('bayar').value);
            var diterima = parseFloat(this.value);
            var errorMessage = document.getElementById('error-message');
            var kembalian = document.getElementById('kembalian');

            errorMessage.style.display = "none";
            kembalian.value = "Rp. 0";

            //Cek jika input 'diterima' kosong
            if (isNaN(diterima) || diterima === "") {
                errorMessage.innerHTML = "Uang Tidak Boleh Kosong";
                errorMessage.style.display = "block";
                return;
            }

            //Hitung kembalian
            var kembalian = diterima - bayar;

            //Jika kembalian negatif, tampilakan pesan error da set kembalian jadi Rp. 0
            if (kembalian < 0) {
                errorMessage.innerHTML = "Uang tidak boleh kurang dari total bayar";
                errorMessage.style.display = "block";
                kembalian.value = "Rp. 0";
                return;
            }
            //Jika tidak ada error, sembunyikan pesan error dan tampilkan kembalian
            errorMessage.style.display = "none";
            kembalian.value = "Rp. " + kembalian.toLocaleString('id-ID');
        });
</script> --}}
