<?php

namespace App\Console\Commands;

use App\Events\NewUserEvent;
use E4\Messaging\Consumer;
use E4\Messaging\Facades\Messaging;
use E4\Messaging\MessageBroker;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;
use E4\Messaging\Utils\MsgSecurity;

class ConsumeMessage extends Command
{

    protected $signature = 'consume:message';

    protected $description = 'Consume Rabbit Queue Messages';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle(MessageBroker $messageBroker)
    {
        $messageBroker->consume(function (AMQPMessage $message) {
            $messageSecurity = new MsgSecurity(
                config('messagingapp.encryption.secretKey'),
                config('messagingapp.encryption.method'),
                config('messagingapp.encryption.algorithm'),
                config('messagingapp.signature.algorithm'),
                file_get_contents(config('messagingapp.signature.publicKey')),
                file_get_contents(config('messagingapp.signature.privateKey')),
            );
            $events =  config('messagingapp.events');
            if (array_key_exists($message->getRoutingKey(), $events)) {
                event(new $events[$message->getRoutingKey()]($messageSecurity->prepareMsgToReceive($message->body)->jsonSerialize()));
            }
        });
    }
}
