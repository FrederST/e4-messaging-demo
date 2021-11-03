<?php

namespace App\Console\Commands;

use App\Events\NewUserEvent;
use E4\Messaging\Consumer;
use E4\Messaging\Facades\Messaging;
use E4\Messaging\MessageBroker;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;
use E4\Messaging\Utils\MsgSecurity;
use Illuminate\Support\Facades\Event;

class ConsumeMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consume:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume Rabbit Queue Messages';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MessageBroker $messageBroker)
    {
        $messageBroker->consume(function (AMQPMessage $message) {
            // $this->error($message->body);
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
                $this->error($events[$message->getRoutingKey()]);
                // Event::dispatch($events[$message->getRoutingKey()], $messageSecurity->prepareMsgToReceive($message->body)->jsonSerialize());
                event(new $events[$message->getRoutingKey()]($messageSecurity->prepareMsgToReceive($message->body)->jsonSerialize()));
            }
            // $this->error($message->getRoutingKey());
            // $message->ack();
        });
    }
}
