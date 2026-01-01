<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function store(StoreSubmissionRequest $request, Task $task): RedirectResponse
    {
        $file = $request->validatedFile();
        $path = $file->store('submissions');
        $isLate = now()->gt($task->deadline_at);

        $submission = TaskSubmission::create([
            'task_id' => $task->id,
            'user_id' => $request->user()->id,
            'path' => $path,
            'submitted_at' => now(),
            'is_late' => $isLate,
        ]);

        AuditLog::create([
            'user_id' => $request->user()->id,
            'event' => 'task_submitted',
            'auditable_type' => Task::class,
            'auditable_id' => $task->id,
            'ip_address' => $request->ip(),
            'metadata' => ['submission_id' => $submission->id, 'is_late' => $isLate],
        ]);

        return redirect()->back()->with('status', 'Submission uploaded');
    }
}
