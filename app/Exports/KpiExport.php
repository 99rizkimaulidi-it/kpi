<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Collection;

class KpiExport implements FromView
{
    public function __construct(private Collection $data)
    {
    }

    public function view(): View
    {
        return view('reports.kpi_excel', ['scores' => $this->data]);
    }
}
