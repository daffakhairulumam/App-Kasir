@extends('layouts.mainLayout')

@section('title', 'Admin - Kategori')

@section('content')
    <h1>Kategori</h1>

    <table class="table">

        <div class="text-end mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkategori">
                Tambah Kategori
            </button>
        </div>

        <br>
        @if (Session::has('status'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        @include('admin.modal-kategori.kategori_add')

        <table class="table">
            <thead>
                <tr>
                    <td>No.</td>
                    <td>Nama Kategori</td>
                    <td>Keterangan</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->nama_kategori }}</td>
                        <td>{{ $value->keterangan }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#editkategori{{ $value->id }}">
                                <button type="button" class="btn btn-success">
                                    Update
                                </button>
                            </a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#hapuskategori{{ $value->id }}">
                                <button type="button" class="btn btn-danger">
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                    @include('admin.modal-kategori.kategori_update')
                    @include('admin.modal-kategori.kategori_delete')
                @endforeach
            </tbody>
        </table>
    @endsection

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
