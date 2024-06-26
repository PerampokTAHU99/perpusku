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
        $listBuku = Buku::all()->sortByDesc('created_at');
        $listUser = User::all()->sortByDesc('created_at');
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

        Peminjaman::create($data);

        return redirect()->route('peminjaman.index')->with('status', "SUCCESS");
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->except('_token');
        Peminjaman::where('id_peminjaman', $id)->update($data);
        return redirect()->route('peminjaman.index')->with('status', "SUCCESS");
    }

    public function destroy($id): RedirectResponse
    {
        Peminjaman::destroy($id);
        return redirect()->route('peminjaman.index')->with('status', "SUCCESS");
    }
}
