<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('dashboard',[
        'active' => 'home',
    ]);
});

Route::get('/admin', function () {
    return view('admin',[
        'active' => 'admin',
    ]);
});

Route::get('/anggota', function () {
    return view('anggota',[
        'active' => 'anggota',
    ]);
});

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

Route::post('/buku', [BukuController::class, 'create'])->name('buku.create');

Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

Route::post('/buku/{id}/destroy', [BukuController::class, 'destroy'])->name('buku.destroy');


Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

Route::post('/peminjaman', [PeminjamanController::class, 'create'])->name('peminjaman.create');

Route::post('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');

Route::post('/peminjaman/{id}/destroy', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');


Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

Route::resource('users', UserController::class);


Route::get('/admin', [UserController::class, 'index']);


