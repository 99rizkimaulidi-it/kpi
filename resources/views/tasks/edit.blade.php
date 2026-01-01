@extends('layouts.app')

@section('content')
<h4>Edit Task</h4>
<form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('tasks.form')
</form>
@endsection
