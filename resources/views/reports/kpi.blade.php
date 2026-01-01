@extends('layouts.app')

@section('content')
<h4>KPI Recap</h4>
<div class="mb-3">
    <a class="btn btn-outline-success" href="{{ route('reports.excel') }}">Export Excel</a>
    <a class="btn btn-outline-danger" href="{{ route('reports.pdf') }}">Export PDF</a>
</div>
<table class="table table-striped">
    <thead><tr><th>Period</th><th>Employee</th><th>Tasks</th><th>Average</th></tr></thead>
    <tbody>
    @foreach($scores as $score)
        <tr>
            <td>{{ $score->period }}</td>
            <td>{{ $score->user->name }}</td>
            <td>{{ $score->total_tasks }}</td>
            <td>{{ number_format($score->average_score,2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $scores->links() }}
@endsection
