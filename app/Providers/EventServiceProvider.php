<?php

namespace App\Providers;

use App\Events\CommerceCreatedEvent;
use App\Listeners\CommerceCreatedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CommerceCreatedEvent::class => [
            CommerceCreatedListener::class
        ]
    ];

    public function boot()
    {
    }
}
