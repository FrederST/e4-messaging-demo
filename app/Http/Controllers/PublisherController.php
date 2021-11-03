<?php

namespace App\Http\Controllers;

use E4\Messaging\Facades\Messaging;
use E4\Messaging\MessageBroker;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function publish(Request $request, MessageBroker $messageBroker)
    {
        $messageBroker->publish('genare::report', '', $request->all());
        return 'Success';
    }
}
