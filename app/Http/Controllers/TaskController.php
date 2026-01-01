<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskFile;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::with(['assignee', 'creator'])->latest()->paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $karyawan = User::whereHas('roles', fn ($q) => $q->where('slug', 'karyawan'))->get();
        return view('tasks.create', compact('karyawan'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline_at' => $request->deadline_at,
            'creator_id' => $request->user()->id,
            'assignee_id' => $request->assignee_id,
        ]);

        foreach ($request->validatedFiles() as $file) {
            $path = $file->store('tasks');
            TaskFile::create([
                'task_id' => $task->id,
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'visibility' => 'private',
            ]);
        }

        AuditLog::create([
            'user_id' => $request->user()->id,
            'event' => 'task_created',
            'auditable_type' => Task::class,
            'auditable_id' => $task->id,
            'ip_address' => $request->ip(),
            'metadata' => $task->only(['title', 'deadline_at']),
        ]);

        return redirect()->route('tasks.index')->with('status', 'Task created');
    }

    public function edit(Task $task): View
    {
        $karyawan = User::whereHas('roles', fn ($q) => $q->where('slug', 'karyawan'))->get();
        return view('tasks.edit', compact('task', 'karyawan'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        if ($request->hasFile('files')) {
            foreach ($request->validatedFiles() as $file) {
                $path = $file->store('tasks');
                TaskFile::create([
                    'task_id' => $task->id,
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'visibility' => 'private',
                ]);
            }
        }

        AuditLog::create([
            'user_id' => $request->user()->id,
            'event' => 'task_updated',
            'auditable_type' => Task::class,
            'auditable_id' => $task->id,
            'ip_address' => $request->ip(),
            'metadata' => $task->only(['title', 'deadline_at']),
        ]);

        return redirect()->route('tasks.index')->with('status', 'Task updated');
    }
}
