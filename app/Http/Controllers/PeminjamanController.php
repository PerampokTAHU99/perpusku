<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function index(Request $request): View
    {
        $listBuku = Buku::all()->sortBy('judul')->values()->all();
        $listUser = User::all()->sortBy('name')->values()->all();
        $listPeminjaman = Peminjaman::with(['buku', 'user'])->get();

        return view('peminjaman', [
            'listPeminjaman' => $listPeminjaman,
            'listBuku' => $listBuku,
            'listUser' => $listUser
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $data = $request->post();

        $buku = Buku::find($data['id_buku']);
        if ($buku->stok < $data['jumlah_pinjaman']) {
            return redirect()->route('peminjaman.index')->with(['status' => 'ERROR', 'message' => 'Stok buku tidak mencukupi']);
        }

        $buku->stok = $buku->stok - $data['jumlah_pinjaman'];
        $buku->save();

        Peminjaman::create($data);

        return redirect()->route('peminjaman.index')->with('status', "SUCCESS");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'id_buku' => ['sometimes', 'required', 'numeric', 'exists:buku,id_buku'],
            'id_user' => ['sometimes', 'required', 'numeric', 'exists:users,id_user'],
            'jumlah_pinjaman' => ['sometimes', 'required', 'integer', 'min:1'],
            'tgl_pinjaman' => ['sometimes', 'required', 'date'],
            'tgl_pengembalian' => ['sometimes', 'required', 'date'],
        ]);

        $peminjaman = Peminjaman::where('id_peminjaman', $id)->firstOrFail();

        if ($data['id_buku'] == $peminjaman->id_buku && (($peminjaman->buku->stok + $peminjaman->jumlah_pinjaman) < $data['jumlah_pinjaman'])) {
            return redirect()->route('pengembalian.index')->with(['status' => 'ERROR', 'message' => 'Stok buku tidak mencukupi']);
        }

        if ($data['id_buku'] == $peminjaman->id_buku) {
            $difference = $peminjaman->jumlah_pinjaman - $data['jumlah_pinjaman'];
            $peminjaman->buku->stok += $difference;

            $peminjaman->buku->save();
        }

        $oldIdBuku = $peminjaman->id_buku;
        $oldJumlahPinjaman = $peminjaman->jumlah_pinjaman;

        $peminjaman->fill($data);
        $peminjaman->save();
        $peminjaman->load('buku', 'user');

        if ($oldIdBuku != $peminjaman->id_buku) {
            $oldBukuData = Buku::where('id_buku', $oldIdBuku)->firstOrFail();

            $oldBukuData->stok += $oldJumlahPinjaman;
            $oldBukuData->save();

            $peminjaman->buku->stok -= $peminjaman->jumlah_pinjaman;
            $peminjaman->buku->save();
        }

        return redirect()->route('peminjaman.index')->with('status', "SUCCESS");
    }

    public function destroy($id): RedirectResponse
    {
        $peminjaman = Peminjaman::find($id)->first();

        $peminjaman->buku->stok += $peminjaman->jml_pinjam;
        $peminjaman->buku->save();

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('status', "SUCCESS");
    }
}
