<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

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
    return view('buku',[
        'active' => 'buku',
    ]);
});

Route::get('/admin', function () {
    return view('admin',[
        'active' => 'admin',
    ]);
});

Route::get('/peminjaman', function () {
    return view('peminjaman',[
        'active' => 'peminjaman',
    ]);
});

Route::get('/pengembalian', function () {
    return view('pengembalian',[
        'active' => 'pengembalian',
    ]);
});

Route::get('/denda', function () {
    return view('denda',[
        'active' => 'denda',
    ]);
});