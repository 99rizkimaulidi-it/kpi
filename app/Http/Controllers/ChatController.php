<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Support\Facades\Broadcast;

class ChatController extends Controller
{
    public function index(): View
    {
        $chats = Chat::with('users')->withCount('messages')->get();
        $users = User::all();
        return view('chat.index', compact('chats', 'users'));
    }

    public function storeMessage(StoreMessageRequest $request, Chat $chat): RedirectResponse
    {
        $attachment = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')->store('chat');
        }

        $message = ChatMessage::create([
            'chat_id' => $chat->id,
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'attachment_path' => $attachment,
        ]);

        Broadcast::event('chat.message', ['chat_id' => $chat->id, 'message' => $message->message]);

        return redirect()->back();
    }
}
