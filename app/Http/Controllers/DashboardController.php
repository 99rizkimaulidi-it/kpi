<?php

namespace App\Http\Controllers;

use App\Models\KpiScore;
use App\Models\Task;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $topScores = KpiScore::with('user')
            ->orderByDesc('average_score')
            ->orderByDesc('total_tasks')
            ->take(10)
            ->get();

        $activeTasks = Task::with('assignee')
            ->whereNull('status')
            ->orderBy('deadline_at')
            ->get();

        return view('dashboard.index', [
            'topScores' => $topScores,
            'activeTasks' => $activeTasks,
        ]);
    }
}
