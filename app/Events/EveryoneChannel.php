<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EveryoneChannel implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;
    public $data;

    public function __construct(string $event, $data)
    {
        $this->event = $event;
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('my-data');
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
