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

Route::get('/buku', function () {
    return view('buku');
});