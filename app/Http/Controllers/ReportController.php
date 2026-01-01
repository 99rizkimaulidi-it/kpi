<?php

namespace App\Http\Controllers;

use App\Models\KpiScore;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportExcel(): Response
    {
        $fileName = 'kpi_recap.xlsx';
        $data = KpiScore::with('user')->get();
        return Excel::download(new \App\Exports\KpiExport($data), $fileName);
    }

    public function exportPdf(): Response
    {
        $data = KpiScore::with('user')->get();
        $pdf = Pdf::loadView('reports.kpi_pdf', ['scores' => $data]);
        return $pdf->download('kpi_recap.pdf');
    }
}
