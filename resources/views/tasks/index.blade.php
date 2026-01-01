@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Tasks</h4>
    <a class="btn btn-primary" href="{{ route('tasks.create') }}">Create Task</a>
</div>
<table class="table table-bordered">
    <thead><tr><th>Title</th><th>Assignee</th><th>Deadline</th><th>Status</th><th></th></tr></thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->assignee->name }}</td>
            <td>{{ $task->deadline_at->format('d M Y H:i') }}</td>
            <td>{{ $task->status ?? 'Pending' }}</td>
            <td><a class="btn btn-sm btn-outline-secondary" href="{{ route('tasks.edit', $task) }}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $tasks->links() }}
@endsection
