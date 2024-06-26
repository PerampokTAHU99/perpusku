<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index(Request $request): View
    {
        $listPengembalian = Pengembalian::all();
        $listBuku = Buku::all()->sortBy('judul')->values()->all();
        $listUser = User::where('id_role', 2)->orderBy('name')->get()->values()->all();
        $listPeminjaman = Peminjaman::all();
        $listPeminjamanUserIds = Peminjaman::pluck('id_user')->toArray();
        $listPengembalianUserIds = Pengembalian::pluck('id_user')->toArray();

        return view('pengembalian', [
            'listPengembalian' => $listPengembalian,
            'listBuku' => $listBuku,
            'listUser' => $listUser,
            'listPeminjaman' => $listPeminjaman,
            'listPeminjamanUserIds' => $listPeminjamanUserIds,
            'listPengembalianUserIds' => $listPengembalianUserIds
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $idUser = $request->post('id_user');
        $idBuku = $request->post('id_buku-create');
        $tglPengembalian = $request->post('tgl_pengembalian');
        $idPeminjaman = $request->post('id_peminjaman');
        $jmlPengembalian = $request->post('jml_pengembalian');

        if (!$jmlPengembalian) {
            $jmlPengembalian = 1;
        }

        $pengembalian = new Pengembalian();
        $pengembalian->id_peminjaman = $idPeminjaman;
        $pengembalian->id_buku = $idBuku;
        $pengembalian->id_user = $idUser;
        $pengembalian->tgl_pengembalian = $tglPengembalian;
        $pengembalian->jumlah_pengembalian = $jmlPengembalian;
        $pengembalian->save();

        return redirect()->route('pengembalian.index')->with('status', "SUCCESS");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $pengembalian = Pengembalian::find($id);
        $pengembalian->update($request->post());
        return redirect()->route('pengembalian.index')->with('status', "SUCCESS");
    }

    public function destroy($id): RedirectResponse
    {
        $pengembalian = Pengembalian::find($id);
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with('status', "SUCCESS");
    }
}
