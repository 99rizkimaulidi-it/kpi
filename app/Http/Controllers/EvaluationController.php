<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Rating;
use App\Models\TaskSubmission;
use App\Models\KpiScore;
use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;

class EvaluationController extends Controller
{
    public function store(StoreRatingRequest $request, TaskSubmission $submission): RedirectResponse
    {
        $rating = Rating::create([
            'task_submission_id' => $submission->id,
            'evaluator_id' => $request->user()->id,
            'score' => $request->score,
            'review' => $request->review,
        ]);

        $this->updateKpi($submission);

        AuditLog::create([
            'user_id' => $request->user()->id,
            'event' => 'task_evaluated',
            'auditable_type' => TaskSubmission::class,
            'auditable_id' => $submission->id,
            'ip_address' => $request->ip(),
            'metadata' => $rating->only(['score']),
        ]);

        return redirect()->back()->with('status', 'Evaluation saved');
    }

    protected function updateKpi(TaskSubmission $submission): void
    {
        $assigneeId = $submission->user_id;
        $period = now()->format('Y-m');
        $scores = Rating::whereHas('submission', fn ($q) => $q->where('user_id', $assigneeId))
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->pluck('score');

        $average = $scores->avg();
        $total = $scores->count();

        KpiScore::updateOrCreate(
            ['user_id' => $assigneeId, 'period' => $period],
            ['average_score' => $average, 'total_tasks' => $total]
        );
    }
}
