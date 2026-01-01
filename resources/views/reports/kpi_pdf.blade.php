<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>KPI Recap</title></head>
<body>
<h2>KPI Recap</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="6">
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
</body>
</html>
