<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Denda;
use Illuminate\View\View;

class DendaController extends Controller
{
    public function index(Request $request): View
    {
        $listDenda = Denda::all();
        return view('denda', ['active' => 'denda', 'listDenda' => $listDenda]);
    }

    public function put(Request $request, $id): RedirectResponse
    {
        $denda = Denda::find($id);
        $denda->is_lunas = true;
        $denda->tgl_denda = now()->format('Y-m-d');
        $denda->save();
        return redirect()->route('denda.index')->with('status', 'Denda diterima');
    }
}
