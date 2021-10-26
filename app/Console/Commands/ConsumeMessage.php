<?php

namespace App\Console\Commands;

use E4\Messaging\Consumer;
use E4\Messaging\Facades\Messaging;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;

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
    public function handle()
    {
        Messaging::consume(function (AMQPMessage $message) {
            $this->error($message->body);
            $message->ack();
        });
    }
}
