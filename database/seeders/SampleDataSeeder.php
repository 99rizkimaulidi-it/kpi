<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\Rating;
use App\Models\User;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $coAdmin = User::whereHas('roles', fn ($q) => $q->where('slug', 'co-admin'))->first();
        $employee = User::whereHas('roles', fn ($q) => $q->where('slug', 'karyawan'))->first();

        if ($coAdmin && $employee) {
            $task = Task::create([
                'title' => 'Prepare Monthly Report',
                'description' => 'Compile and upload the monthly KPI report.',
                'deadline_at' => now()->addDays(5),
                'creator_id' => $coAdmin->id,
                'assignee_id' => $employee->id,
            ]);

            $submission = TaskSubmission::create([
                'task_id' => $task->id,
                'user_id' => $employee->id,
                'path' => 'submissions/sample.pdf',
                'submitted_at' => now()->addDays(2),
                'is_late' => false,
            ]);

            Rating::create([
                'task_submission_id' => $submission->id,
                'evaluator_id' => $coAdmin->id,
                'score' => 5,
                'review' => 'Excellent work delivered on time.',
            ]);
        }
    }
}
