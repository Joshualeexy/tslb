<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;   

class UpdateError implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

  public function __construct(public string $data)
    {
    }


     public function broadcastOn(): array
    {
        return [
            new Channel('realtimeupdate'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'updateerror';
    }
}
