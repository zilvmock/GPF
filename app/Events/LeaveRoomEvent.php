<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeaveRoomEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomId;

    public function __construct($roomId)
    {
        $this->roomId = $roomId;
    }

    public function broadcastOn()
    {
        return new Channel('room.' . $this->roomId);
    }

    public function broadcastAs()
    {
        return 'leave-room';
    }
}
