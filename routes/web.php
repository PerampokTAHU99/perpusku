<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

Route::post('/buku', [BukuController::class, 'create'])->name('buku.create');

Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

Route::post('/buku/{id}/destroy', [BukuController::class, 'destroy'])->name('buku.destroy');
