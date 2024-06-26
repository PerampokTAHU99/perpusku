<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function index(Request $request): View
    {
        $buku = Buku::all();

        return view('buku', ['listBuku' => $buku]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'sampul' => 'required|file|mimes:jpg,jpeg,png,bmp,webp|max:2048',
        ]);

        $filepath = $request->file('sampul')->store('uploads', 'public');

        $buku = new Buku();
        $buku->judul = $request->post('judul');
        $buku->penulis = $request->post('penulis');
        $buku->penerbit = $request->post('penerbit');
        $buku->stok = $request->post('stok');
        $buku->harga = $request->post('harga');
        $buku->sampul = $filepath;
        $buku->keterangan = $request->post('keterangan');
        $buku->kategori = $request->post('kategori');
        $buku->save();

        return redirect()->route('buku.index');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $buku = Buku::where('id_buku', $id)->first();

        if (!$buku) {
            return redirect()->route('buku.index')->with(['status' => 'ERROR', 'message' => 'Buku tidak ditemukan']);
        }

        $judul = $request->post('judul');
        $penulis = $request->post('penulis');
        $penerbit = $request->post('penerbit');
        $stok = $request->post('stok');
        $harga = $request->post('harga');
        $keterangan = $request->post('keterangan');
        $kategori = $request->post('kategori');

        $buku->judul = $judul ?? $buku->judul;
        $buku->penulis = $penulis ?? $buku->penulis;
        $buku->penerbit = $penerbit ?? $buku->penerbit;
        $buku->stok = $stok ?? $buku->stok;
        $buku->harga = $harga ?? $buku->harga;
        $buku->keterangan = $keterangan ?? $buku->keterangan;
        $buku->kategori = $kategori ?? $buku->kategori;

        if ($request->file('sampul')) {
            $file = $request->file('sampul');
            $filepath = $file->store('uploads', 'public');
            $buku->sampul = $filepath;
        }

        $buku->save();

        return redirect()->route('buku.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $buku = Buku::where('id_buku', $id)->first();

        if (!$buku) {
            return redirect()->route('buku.index');
        }

        $buku->delete();
        return redirect()->route('buku.index');
    }
}
