<?php


namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('presence-chat-channel.' . $this->getChannelId($this->message));
    }


    protected function getChannelId()
    {
        $ids = [$this->message->sender_id, $this->message->receiver_id];
        sort($ids);
        return implode('-', $ids);
    }


    public function broadcastAs()
    {
        return 'new-message';
    }
}
