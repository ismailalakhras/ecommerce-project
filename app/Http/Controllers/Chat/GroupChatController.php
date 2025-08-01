<?php

namespace App\Http\Controllers\Chat;

use App\Events\NewGroupMessage;
use App\Http\Controllers\Controller;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupChatController extends Controller
{
    public function messages($groupId)
    {
        $group = GroupChat::with('messages.sender')->findOrFail($groupId);

        return response()->json([
            'messages' => $group->messages->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'sender' => $msg->sender->name,
                    'sender_id' => $msg->sender->id,
                    'avatar' => $msg->sender->avatar,
                    'message' => $msg->message,
                    'created_at' => $msg->created_at->diffForHumans(),
                ];
            })
        ]);
    }

    public function sendMessage(Request $request, $groupId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        $group = GroupChat::findOrFail($groupId);

        $message = $group->messages()->create([
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        broadcast(new NewGroupMessage($message));

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => [
                'sender' => $user->name,
                'message' => $message->message,
                'created_at' => $message->created_at,
            ]
        ]);
    }

    public function members($groupId)
    {
        $group = GroupChat::with('users')->findOrFail($groupId);

        return response()->json([
            'members' => $group->users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            })
        ]);
    }


    public function groups()
    {
        $groups = GroupChat::withCount('users')->get(); 

        return response()->json([
            'groups' => $groups->map(function ($group) {
                return [
                    'id' => $group->id,
                    'name' => $group->name,
                    'members_count' =>  $group->users->count(), 
                ];
            })
        ]);
    }
}
