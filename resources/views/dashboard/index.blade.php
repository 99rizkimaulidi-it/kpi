@extends('layouts.app')

@section('content')
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">Top KPI - {{ now()->format('F Y') }}</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead><tr><th>Employee</th><th>Tasks</th><th>Average</th></tr></thead>
                    <tbody>
                    @foreach($topScores as $score)
                        <tr>
                            <td>{{ $score->user->name }}</td>
                            <td>{{ $score->total_tasks }}</td>
                            <td>{{ number_format($score->average_score,2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">Open Tasks</div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($activeTasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $task->title }} — {{ $task->assignee->name }}</span>
                            <span class="badge bg-secondary">{{ $task->deadline_at->format('d M Y H:i') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item">No open tasks</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
