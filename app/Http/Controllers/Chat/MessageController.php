<?php

namespace App\Http\Controllers\Chat;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;


class MessageController extends Controller
{


    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('backend.pages.chat.index', compact('users'));
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        $message->load('sender');

        broadcast(new NewMessage($message))->toOthers();

        return response()->json($message);
    }

    public function getMessages($receiverId)
    {
        $senderId = auth()->id();

        $messages = Message::with('sender')
            ->where(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $senderId)
                    ->where('receiver_id', $receiverId);
            })->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'sender_id' => $msg->sender_id,
                    'receiver_id' => $msg->receiver_id,
                    'message' => $msg->message,
                    'created_at' => $msg->created_at->toDateTimeString(),
                    'sender_name' => $msg->sender->name ?? 'Unknown',
                    'avatar' => $msg->sender->avatar ?? 'Unknown',
                ];
            });
        return response()->json($messages);
    }
}
