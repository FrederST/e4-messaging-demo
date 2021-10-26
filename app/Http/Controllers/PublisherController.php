<?php

namespace App\Http\Controllers;

use E4\Messaging\Facades\Messaging;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function publish(Request $request)
    {
        Messaging::publish('test_queue', $request->all());
        return 'Success';
    }
}
