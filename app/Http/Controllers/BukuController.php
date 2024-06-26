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
        $buku = new Buku();
        $buku->judul = $request->post('judul');
        $buku->penulis = $request->post('penulis');
        $buku->penerbit = $request->post('penerbit');
        $buku->stok = $request->post('stok');
        $buku->harga = $request->post('harga');
        $buku->sampul = $request->file('sampul');
        $buku->keterangan = $request->post('keterangan');
        $buku->kategori = $request->post('kategori');
        $buku->save();

        return redirect()->route('buku.index');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $buku = Buku::where('id_buku', $id)->first();

        if (!$buku) {
            return redirect()->route('buku.index');
        }

        $buku->judul = $request->post('judul');
        $buku->penulis = $request->post('penulis');
        $buku->penerbit = $request->post('penerbit');
        $buku->stok = $request->post('stok');
        $buku->harga = $request->post('harga');
        $buku->sampul = $request->file('sampul');
        $buku->keterangan = $request->post('keterangan');
        $buku->kategori = $request->post('kategori');
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
