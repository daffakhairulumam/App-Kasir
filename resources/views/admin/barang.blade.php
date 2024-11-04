@extends('layouts.mainLayout')

@section('title', 'Admin - Barang')

@section('content')
    <h1>Barang</h1>

    <div class="text-end mb-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbarang">
            Tambah Barang
        </button>
    </div>

    <br>
    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    @include('admin.modal-barang.barang_add')

    <table class="table">
        <thead>
            <tr>
                <td>No.</td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Nama Kategori</td>
                <td>Gambar</td>
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
                    <td>{{ $value->kategori->nama_kategori }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $value->gambar) }}" height="50px">
                    </td>
                    <td>{{ $value->stock }}</td>
                    <td>{{ $value->harga }}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#editbarang{{ $value->id }}">
                            <button type="button" class="btn btn-primary">
                                Update
                            </button>
                        </a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#hapusbarang{{ $value->id }}">
                            <button type="button" class="btn btn-danger">
                                Delete
                            </button>
                        </a>
                    </td>
                </tr>
                @include('admin.modal-barang.barang_update')
                @include('admin.modal-barang.barang_delete')
            @endforeach
        </tbody>
    </table>
@endsection

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
