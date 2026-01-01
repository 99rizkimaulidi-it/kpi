<table>
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
