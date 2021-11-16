<?php

namespace App\Events;

use E4\Messaging\AMQPMessageStructure;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommerceCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private AMQPMessageStructure $message;

    public function __construct(AMQPMessageStructure $message)
    {
        $this->message = $message;
    }

    public function message(): AMQPMessageStructure
    {
        return $this->message;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }
}
