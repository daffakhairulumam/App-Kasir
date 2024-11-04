<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['kategori'] = Kategori::all();
        return view('admin.kategori', $data);
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
        // insert table kategori

        // dd(request);
        // $kategori = Kategori::create($request->all());
        // return redirect('/admin/kategori');

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->keterangan = $request->keterangan;
        $kategori->save();
        Session::flash('status', 'success');
        Session::flash('message', 'Data kategori berhasil ditambahkan');
        return redirect('/admin/kategori');
        return redirect('/admin/kategori');

        // $kategori = new Kategori;
        // $kategori->nama_kategori = $request->nama_kategoril;
        // $kategori->keterangan = $request->keterangan;
        // $kategori->save();
        // return redirect('/admin/kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->keterangan = $request->keterangan;
        $kategori->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Data kategori berhasil diubah');
        return redirect('/admin/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        Session::flash('status', 'danger');
        Session::flash('message', 'Data kategori berhasil dihapus');
        return redirect('/admin/kategori');
    }
}
