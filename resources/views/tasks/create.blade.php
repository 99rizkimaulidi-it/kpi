@extends('layouts.app')

@section('content')
<h4>Create Task</h4>
<form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
    @csrf
    @include('tasks.form')
</form>
@endsection
