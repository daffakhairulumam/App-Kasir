<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['barang'] = Barang::all();
        $data['keranjang'] = Keranjang::all();
        $data['total'] = $data['keranjang']->sum('subtotal');
        $data['kodeTransaksi'] = $this->kodeOtomatis();
        return view('admin.transaksi', $data);
    }

    public function kodeOtomatis()
    {
        $query = Transaksi::selectRaw('MAX(RIGHT(kode_transaksi, 3)) AS max_number');
        $kode = '001';
        if ($query->count() > 0) {
            $data = $query->first();
            $number = ((int) $data->max_number) + 1;
            $kode = sprintf('%03s', $number);
        }
        return 'TRX' . $kode;
    }

    public function simpanTransaksi()
    {
        $kode_transaksi = $this->kodeOtomatis();
        $tanggal_transaksi = Carbon::now()->format('Y-m-d');
        $keranjang = Keranjang::all();
        $total = $keranjang->sum('subtotal');

        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $kode_transaksi;
        $transaksi->tanggal_transaksi = $tanggal_transaksi;
        $transaksi->total = $total;
        $transaksi->save();

        foreach ($keranjang as $key => $value) {
            $detail = new TransaksiDetail();
            $detail->transaksi_id = $kode_transaksi;
            $detail->barang_id = $value->kode_barang;
            $detail->qty = $value->qty;
            $detail->harga = $value->harga;
            $detail->subtotal = $value->subtotal;
            $detail->save();
        }
        //hapus semua item keranjang
        Keranjang::truncate();

        Session::flash('status', 'success');
        Session::flash('message', 'Transaksi berhasil');

        //redirect ke halaman transaksi
        return redirect('/admin/transaksi');
    }

    public function updateQty(Request $request, $id)
    {
        // Validasi input untuk memastikan qty adalah integer minimal 1
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        // Cari item keranjang berdasarkan id
        $keranjang = Keranjang::findOrFail($id);
        // simpan qty lama sebelum diubah
        $qtyLama = $keranjang->qty;

        // Update qty dan subtotal
        $keranjang->qty = $request->input('qty');
        $keranjang->subtotal = $keranjang->qty * $keranjang->harga;

        // Hitung selisih qty untuk menentukan pengurangan stok
        $qtyBaru = $keranjang->qty;
        $selisihQty = $qtyBaru - $qtyLama;

        // Cari data barang berdasarkan kode_barang di keranjang
        $barang = Barang::where('kode_barang', $keranjang->kode_barang)->first();

        // Kurangi stok barang berdasarkan selisih qty
        $barang->stock -= $selisihQty;
        $barang->save(); // Simpan perubahan stok barang

        // Simpan perubahan pada keranjang
        $keranjang->save();

        // Kembali ke halaman transaksi
        return redirect('/admin/transaksi');
    }

    public function add_cart($id)
    {
        $barang = Barang::findOrFail($id);
        //cek apakah kode_barang sudah ada di table keranjang
        $keranjang = Keranjang::where('kode_barang', $barang->kode_barang)->first();
        if ($keranjang) {
            //jika keranjang == true atau tudak NULL/barang ada
            $keranjang->qty += 1; //menamabah qty
            $keranjang->subtotal = $keranjang->qty * $keranjang->harga;
        } else {
            //jika barang belum ada di keranjang , buat data keranjang baru
            $keranjang = new Keranjang;
            // $keranjang->kode_transaksi = $this->kodeOtomatis();
            $keranjang->kode_barang = $barang->kode_barang;
            $keranjang->nama_barang = $barang->nama_barang;
            $keranjang->harga = $barang->harga;
            $keranjang->qty = 1;
            $keranjang->subtotal = $keranjang->qty * $keranjang->harga;
        }
        // Mengurangi stok barang dan menyimpan perubahannya
        $barang->stock -= $keranjang->qty;
        $barang->save();

        //simpan ke table keranjang
        $keranjang->save();

        //kembali ke halaman transaksi
        return redirect('/admin/transaksi');
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
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // temukan item di keranjang berdasarkan id
        $keranjang = Keranjang::findOrFail($id);

        // temukan barang berdasarkan kode_barang di keranjang
        $barang = Barang::where('kode_barang', $keranjang->kode_barang)->first();

        // tambahkan stok barang sesuai qty di keranjang
        if ($barang) {
            $barang->stock += $keranjang->qty;
            $barang->save();
        }

        // hapus item dari keranjang
        $keranjang->delete();

        // kembali ke halaman transaksi
        return redirect('/admin/transaksi');
    }
}
