<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LockButton extends Component
{
    public $room_id;
    public $room_lock;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.lock-room" => 'render',
        ];
    }

    public function render()
    {
        return view('livewire.lock-button');
    }
}
