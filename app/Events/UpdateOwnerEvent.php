<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateOwnerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room_id;
    public $old_owner_username;
    public $new_owner_username;

    public function __construct($room_id, $old_owner_username, $new_owner_username)
    {
        $this->room_id = $room_id;
        $this->old_owner_username = $old_owner_username;
        $this->new_owner_username = $new_owner_username;
    }

    public function broadcastOn()
    {
        return new Channel('room.' . $this->room_id);
    }

    public function broadcastAs()
    {
        return 'update-owner';
    }

    public function broadcastWith()
    {
        return [
            'old_owner_username' => $this->old_owner_username,
            'new_owner_username' => $this->new_owner_username,
        ];
    }
}
