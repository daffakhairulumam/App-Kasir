<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['barang'] = Barang::with('kategori')->get();
        $data['kategori'] = Kategori::all();
        $data['kodeBarang'] = $this->kodeOtomatis();
        return view('admin.barang', $data);
    }

    public function kodeOtomatis()
    {
        $query = Barang::selectRaw('MAX(RIGHT(kode_barang, 3)) AS max_number');
        $kode = '001';
        if ($query->count() > 0) {
            $data = $query->first();
            $number = ((int) $data->max_number) + 1;
            $kode = sprintf('%03s', $number);
        }
        return 'BRG' . $kode;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data kategori dari tabel kategori
        // $kategori = Kategori::all();

        // Kirim data kategori ke view 'admin.barang.'
        // return view('admin.modal-barang.barang_add', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert table kategori

        // dd(request);
        // $barang = Barang::create($request->all());
        // return redirect('/admin/kategori');

        $barang = new Barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_id = $request->kategori_id;

        //upload gambar
        if ($request->file()) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $request->nama_barang . '_' . time() . '.' . $extension;
            $filePath = $file->storeAs('gambar_barang', $fileNameToStore, 'public');
            $barang->gambar = $filePath;
        }

        $barang->stock = $request->stock;
        $barang->harga = $request->harga;
        $barang->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Data barang berhasil ditambahkan');
        return redirect('/admin/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang, $id)
    {
        //
        $barang = Barang::findOrFail($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori_id = $request->kategori_id;

        //upload gambar
        if ($request->file()) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $request->nama_barang . '_' . time() . '.' . $extension;
            $filePath = $file->storeAs('gambar_barang', $fileNameToStore, 'public');
            $barang->gambar = $filePath;
        }

        $barang->stock = $request->stock;
        $barang->harga = $request->harga;
        $barang->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Data kategori berhasil diubah');
        return redirect('/admin/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang, $id)
    {
        //
        $barang = Barang::findOrFail($id);
        $barang->delete();

        Session::flash('status', 'danger');
        Session::flash('message', 'Data Barang berhasil dihapus');
        return redirect('/admin/barang');
    }
}
