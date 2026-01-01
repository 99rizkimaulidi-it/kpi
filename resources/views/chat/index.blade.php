@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h5>Chats</h5>
        <ul class="list-group mb-3">
            @foreach($chats as $chat)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $chat->name ?? 'Direct' }}</span>
                    <span class="badge bg-secondary">{{ $chat->messages_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-8">
        <h5>New Message</h5>
        <form method="POST" action="{{ $chats->first() ? route('chat.store', $chats->first()) : '#' }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control" name="message" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Attachment</label>
                <input type="file" name="attachment" class="form-control">
            </div>
            <button class="btn btn-primary">Send</button>
        </form>
    </div>
</div>
@endsection
