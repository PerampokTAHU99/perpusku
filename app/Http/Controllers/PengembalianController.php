<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Denda;

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

        $pengembalian = new Pengembalian();
        $pengembalian->id_peminjaman = $idPeminjaman;
        $pengembalian->id_buku = $idBuku;
        $pengembalian->id_user = $idUser;
        $pengembalian->tgl_pengembalian = $tglPengembalian;
        $pengembalian->jumlah_pengembalian = $jmlPengembalian;
        $pengembalian->save();

        $dataBuku = Buku::where('id_buku', $idBuku)->first();
        $dataBuku->stok += $jmlPengembalian;
        $dataBuku->save();

        $dataPeminjaman = Peminjaman::where('id_peminjaman', $idPeminjaman)->first();
        $message = '';

        if ($jmlPengembalian < $dataPeminjaman->jumlah_pinjaman) {
            Denda::create([
                'id_peminjaman' => $pengembalian->id_peminjaman,
                'id_pengembalian' => $pengembalian->id_pengembalian,
                'id_user' => $pengembalian->id_user,
                'tgl_denda' => $pengembalian->tgl_pengembalian,
                'id_buku' => $pengembalian->id_buku,
                'keterangan' => "Menghilangkan Buku"
            ]);

            $message = "Menghilangkan Buku, Dikenakan Denda";
        }

        if ($pengembalian->tgl_pengembalian > $pengembalian->peminjaman->tgl_pengembalian) {
            Denda::create([
                'id_peminjaman' => $pengembalian->id_peminjaman,
                'id_pengembalian' => $pengembalian->id_pengembalian,
                'id_user' => $pengembalian->id_user,
                'tgl_denda' => $pengembalian->tgl_pengembalian,
                'id_buku' => $pengembalian->id_buku,
                'keterangan' => "Telat Mengembalikan Buku"
            ]);

            $message = "Telat Mengembalikan Buku, Dikenakan Denda";
        }

        return redirect()->route('pengembalian.index')->with([
            'status' => "SUCCESS",
            'message' => $message
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $pengembalian = Pengembalian::find($id);
        $pengembalian->update($request->post());
        return redirect()->route('pengembalian.index')->with('status', "SUCCESS");
    }

    public function destroy($id): RedirectResponse
    {
        $pengembalian = Pengembalian::where('id_pengembalian', $id)->first();
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with('status', "SUCCESS");
    }
}
