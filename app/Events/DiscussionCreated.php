<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class DiscussionCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $discussion;

    public function __construct($discussion)
    {
        $this->discussion = $discussion->load('user');
    }

    public function broadcastOn()
    {
        return new PrivateChannel('course.' . $this->discussion->course_id);
    }

    public function broadcastAs()
    {
        return 'discussion.created';
    }
}

