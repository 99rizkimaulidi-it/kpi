<?php

namespace App\Http\Controllers;

use App\Models\KpiScore;
use Illuminate\Contracts\View\View;

class KpiController extends Controller
{
    public function recap(): View
    {
        $scores = KpiScore::with('user')->orderByDesc('period')->paginate(20);
        return view('reports.kpi', compact('scores'));
    }
}
