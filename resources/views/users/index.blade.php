@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Users</h4>
    <a class="btn btn-primary" href="{{ route('users.create') }}">Create</a>
</div>
<table class="table table-bordered">
    <thead><tr><th>Name</th><th>Email</th><th>Status</th><th>Roles</th><th></th></tr></thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
            <td><a class="btn btn-sm btn-outline-secondary" href="{{ route('users.edit', $user) }}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection
