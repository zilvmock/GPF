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
        ];
    }

    public function leaveAllUsersFromRoom()
    {
        return redirect()->route('browse');
    }

    public function render()
    {
        $users = DB::table('users')->where('current_room_id', $this->room_id)->get();
//        $owner = DB::table('users')->where('id', Room::find($this->room_id)->owner_id)->first();
//        $users = $users->filter(function ($user) use ($owner) {
//            return $user->id != $owner->id;
//        });
        return view('livewire.room-users', [
            'users' => $users,
            'owner_id' => $this->owner_id,
        ]);
    }
}
