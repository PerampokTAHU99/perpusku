<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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
