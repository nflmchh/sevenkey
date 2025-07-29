<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockKeluar;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockKeluarExport;
use PDF;

class StockKeluarExportController extends Controller
{
    public function export(Request $request)
    {
        $type = $request->query('type', 'excel');
        $data = StockKeluar::orderBy('tanggal', 'desc')->get();
        if ($type === 'pdf') {
            $pdf = PDF::loadView('exports.stock-keluar-pdf', ['data' => $data]);
            return $pdf->download('stock_keluar_report.pdf');
        } else {
            return Excel::download(new StockKeluarExport($data), 'stock_keluar_report.xlsx');
        }
    }
}
