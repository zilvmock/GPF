<?php

namespace App\Http\Livewire;

use App\Models\Room;
use App\Models\User;
use Livewire\Component;

class RoomUsers extends Component
{
    public $room_id;
    public $room_size;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.join-room" => 'render',
            "echo:room.{$this->room_id},.leave-room" => 'render',
            "echo:room.{$this->room_id},.update-owner" => 'render',
            "echo:room.{$this->room_id},.delete-room" => 'leaveAllUsersFromRoom',
            "echo:room.{$this->room_id},.kick-from-room" => 'leaveKickedUserFromRoom',
        ];
    }

    public function leaveAllUsersFromRoom()
    {
        return redirect()->route('browse');
    }

    public function leaveKickedUserFromRoom()
    {
        if (auth()->user()->current_room_id != $this->room_id) {
            return redirect()->route('browse')->with('error', 'You have been kicked from the room!');
        }
        return $this->render();
    }

    public function render()
    {
        $users = User::select('id', 'username')->where('current_room_id', $this->room_id)->get();
        $owner_id = Room::where('id', $this->room_id)->first()->owner_id;

        return view('livewire.room-users', [
            'users' => $users,
            'owner_id' => $owner_id,
        ]);
    }
}
