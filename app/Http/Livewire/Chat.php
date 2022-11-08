<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $room_id;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.send-message" => 'render',
        ];
    }

    public function render()
    {
        $messages = Message::where('room_id', $this->room_id)->get();
        return view('livewire.chat', [
            'messages' => $messages,
        ]);
    }
}
