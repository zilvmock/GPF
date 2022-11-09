<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RoomUsers extends Component
{
    public $room_id;
    public $owner_id;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.join-room" => 'render',
            "echo:room.{$this->room_id},.leave-room" => 'render',
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
        $users = DB::table('users')->where('current_room_id', $this->room_id)->get();
        return view('livewire.room-users', [
            'users' => $users,
            'owner_id' => $this->owner_id,
        ]);
    }
}
