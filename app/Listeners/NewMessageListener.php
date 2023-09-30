<?php

namespace App\Listeners;

use App\Events\ChatingMessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ChatingMessageEvent $event)
    {
        $message = $event->message;

        return response()->json([
            "message" => $message
        ]);
    }
}
