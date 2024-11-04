<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route login
Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'cek_login'])->name('cek_login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//route tambah kategori dll
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin_kategori');

Route::post('/tambah_kategori', [KategoriController::class, 'store'])->name('tambah_kategori');

Route::put('/update_kategori/{id}', [KategoriController::class, 'update'])->name('update_kategori');

Route::delete('/kategori_delete/{id}', [KategoriController::class, 'destroy'])->name('kategori_delete');

//route tambah barang dll
Route::get('/admin/barang', [BarangController::class, 'index'])->name('admin_barang');

Route::post('/tambah_barang', [BarangController::class, 'store'])->name('tambah_barang');

Route::put('/update_barang/{id}', [BarangController::class, 'update'])->name('update_barang');

Route::delete('/barang_delete/{id}', [BarangController::class, 'destroy'])->name('barang_delete');

//route transaksi
Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin_transaksi');

Route::get('/add_to_cart/{id}', [TransaksiController::class, 'add_cart'])->name('add_cart');

Route::post('/update_cart/{id}', [TransaksiController::class, 'updateQty'])->name('keranjang.update');

Route::delete('/keranjang/{id}', [TransaksiController::class, 'destroy'])->name('keranjang.destroy');

Route::post('/transaksi/simpan', [TransaksiController::class, 'simpanTransaksi'])->name('transaksi.simpan');
