<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;

use App\Http\Middleware\AuthMiddleware;


Route::get('/', function () {
    return view('dashboard', [
        'active' => 'home',
    ]);
})->name('dashboard');

// Rute untuk autentikasi
Route::get(
    '/auth/login', fn () => view('login', ['active' => 'login'])
)->name('auth.login')->withoutMiddleware(AuthMiddleware::class);
Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('auth.authenticate')->withoutMiddleware(AuthMiddleware::class);
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->withoutMiddleware(AuthMiddleware::class);

// Rute untuk admin
Route::get('/admin', [UserController::class, 'index'])->name('admin.index');

// Rute untuk anggota
Route::get('/anggota', [UserController::class, 'showAnggota'])->name('anggota.index');
Route::post('/anggota', [UserController::class, 'store'])->name('anggota.store');
Route::put('/anggota/{id}', [UserController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{id}', [UserController::class, 'destroy'])->name('anggota.destroy');

// Resource route untuk users
Route::resource('/users', UserController::class);

// Rute untuk buku
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::post('/buku', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('/buku/{id}/destroy', [BukuController::class, 'destroy'])->name('buku.destroy');

// Rute untuk peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::post('/peminjaman/{id}/destroy', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

// Rute untuk pengembalian
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::post('/pengembalian', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian/{id}/destroy', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');

// Rute untuk denda
Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
Route::post('/denda/{id}', [DendaController::class, 'put'])->name('denda.put');

// Rute untuk PDF
Route::get('/pdf/test', fn () => view('pdfs.denda'))->withoutMiddleware(AuthMiddleware::class);
Route::get('/pdf/denda', [PDFController::class, 'denda'])->name('pdf.denda');
