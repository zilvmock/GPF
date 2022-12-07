<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $room_id;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.send-message" => 'render',
            "echo:room.{$this->room_id},.join-room:user_username" => 'joinedMessage',
            "echo:room.{$this->room_id},.leave-room:user_username" => 'leftMessage',
            "echo:room.{$this->room_id},.kick-from-room:user_username" => 'kickedMessage',
            "echo:room.{$this->room_id},.update-owner:old_owner_username:new_owner_username" => 'ownerChangedMessage',
        ];
    }

    public function joinedMessage($payload)
    {
        $this->createNotificationMessage("{$payload['user_username']}' joined the room!'", $payload);
    }

    public function leftMessage($payload)
    {
        $this->createNotificationMessage("{$payload['user_username']}' left the room!'", $payload);
    }

    public function kickedMessage($payload)
    {
        $this->createNotificationMessage("{$payload['user_username']}' was kicked from the room!'", $payload);
    }

    public function ownerChangedMessage($payload)
    {
        $this->createNotificationMessage("{$payload['old_owner_username']}' (owner) left the room. '. {$payload['new_owner_username']}' is the new owner!'", $payload);
    }

    public function createNotificationMessage($message, $payload)
    {
        Message::insert([
            'room_id' => $this->room_id,
            'user_id' => User::where('username', $payload['user_username'] ?? $payload['old_owner_username'])->first()->id,
            'message' => $message,
            'is_system_message' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function render()
    {
        $messages = Message::where('room_id', $this->room_id)->oldest()->get();
        return view('livewire.chat', [
            'messages' => $messages,
        ]);
    }
}
