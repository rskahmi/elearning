<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;

    public function __construct($reply)
    {
        $this->reply = $reply->load('user');
    }

    public function broadcastOn()
    {
        return new PrivateChannel('discussion.' . $this->reply->discussion_id);
    }

    public function broadcastAs()
    {
        return 'reply.created';
    }
}

