<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Denda;

class PDFController extends Controller
{
    public function denda(Request $request)
    {
        $dataDenda = Denda::all();

        $pdf = Pdf::loadView('pdfs.denda', [
            'dataDenda' => $dataDenda
        ])->setPaper('A4', 'Portrait');

        return $pdf->stream('denda.pdf');
    }
}
