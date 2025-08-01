<?php

namespace App\Events;

use App\Models\GroupMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewGroupMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public GroupMessage $message;

    public function __construct(GroupMessage $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): PresenceChannel
    {
        return new PresenceChannel('presence-group-chat.' . $this->message->group_chat_id);
    }

    public function broadcastAs(): string
    {
        return 'new-group-message';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'group_chat_id' => $this->message->group_chat_id,
            'message' => $this->message->message,
            'created_at' => $this->message->created_at->toDateTimeString(),
            'time' => $this->message->created_at->diffForHumans(),
            'sender_name' => $this->message->sender->name ?? 'Unknown',
            'avatar' => $this->message->sender->avatar ,
        ];
    }
}
