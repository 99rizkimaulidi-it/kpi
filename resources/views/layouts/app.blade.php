<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KPI') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">KPI</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="/" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('tasks.index') }}" class="nav-link">Tasks</a></li>
                <li class="nav-item"><a href="{{ route('chat.index') }}" class="nav-link">Chat</a></li>
                @can('viewAny', App\Models\User::class)
                    <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">Users</a></li>
                @endcan
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link">Profile</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container py-4">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
