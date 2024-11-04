@extends('layouts.mainLayout')

@section('title', 'Admin - Home')

@section('content')
    <h1>Selamat Datang, {{ Auth::user()->name_users }}</h1>
    <h1>Hak Akses Anda Adalah {{ Auth::user()->role->name_role }}</h1>

    <!-- Menampilkan jumlah kategori dan transaksi -->
    <b>
        <p>Jumlah Kategori: {{ $jumlahKategori }}</p>
        <p>Jumlah Barang: {{ $jumlahBarang }}</p>
        <p>Jumlah Transaksi: {{ $jumlahTransaksi }}</p>
    </b>
@endsection
