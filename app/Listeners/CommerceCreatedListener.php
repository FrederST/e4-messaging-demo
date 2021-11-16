<?php

namespace App\Listeners;

use App\Events\CommerceCreatedEvent;

class CommerceCreatedListener
{
    public function handle(CommerceCreatedEvent $event)
    {
        $message = $event->message();
        print_r($message->body);
        // $message->ack();
    }
}
