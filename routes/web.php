<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::resource('barang', BarangController::class);
Route::get('barang/delete/{id}', [BarangController::class, 'delete']);

Route::resource('supplier', SupplierController::class);
Route::get('supplier/delete/{id}', [SupplierController::class, 'delete']);

Route::resource('pelanggan', PelangganController::class);
Route::get('pelanggan/delete/{id}', [PelangganController::class, 'delete']);

Route::resource('penjualan', PenjualanController::class);


Route::resource('pembelian', PembelianController::class);
Route::get('pembelian/cetak/pdf', [PembelianController::class, 'cetak']);
Route::get('pembelian/delete/{id}', [PembelianController::class, 'delete']);

Route::get('penjualan/lunasi/{id}', [PenjualanController::class, 'lunasi'])->name('penjualan.lunasi');
Route::get('penjualan/invoice/{id}', [PenjualanController::class, 'invoice']);
Route::get('penjualan/cetak/pdf', [PenjualanController::class, 'cetakpdf'])->name('cetak.pdf');

Route::get('/hapus', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'DONE';
});
