<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DendaController;

Route::get('/', function () {
    return view('dashboard',[
        'active' => 'home',
    ]);
});

Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
Route::get('/anggota', [UserController::class, 'showAnggota'])->name('anggota.index');
Route::resource('/users', UserController::class);

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::post('/buku', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('/buku/{id}/destroy', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::post('/peminjaman/{id}/destroy', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::post('/pengembalian', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::post('/pengembalian/{id}/destroy', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');

Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
Route::post('/denda/{id}', [DendaController::class, 'put'])->name('denda.put');
