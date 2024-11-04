<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Menghitung jumlah barang
        $jumlahBarang = Barang::count();
        // Menghitung jumlah kategori
        $jumlahKategori = Kategori::count();
        // Menghitung jumlah transaksi
        $jumlahTransaksi = Transaksi::count();

        return view('admin.home', [
            'jumlahBarang' => $jumlahBarang,
            'jumlahKategori' => $jumlahKategori,
            'jumlahTransaksi' => $jumlahTransaksi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
