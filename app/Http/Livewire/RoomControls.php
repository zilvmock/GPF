<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;

class RoomControls extends Component
{
    public $room_id;
    public $game_slug;
    public $game_id;
    public $room_title;
    public $room_lock;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.update-owner:owner_id" => 'render',
        ];
    }

    public function render()
    {
        $owner_id = Room::where('id', $this->room_id)->first()->owner_id;
        return view('livewire.room-controls', [
            'owner_id' => $owner_id,
        ]);
    }
}
