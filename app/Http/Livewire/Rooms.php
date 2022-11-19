<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Rooms extends Component
{
    public $game_slug;
    public $game_id;
    public $room_id;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.join-room" => 'render',
            "echo:room.{$this->room_id},.leave-room" => 'render',
            "echo:room,.update-rooms" => 'render',
        ];
    }

    public function render()
    {
        $rooms = DB::table('rooms')
            ->where('game_id', $this->game_id)
            ->get()->paginate(10);
        foreach ($rooms as $room) {
            $room->users_count = DB::table('users')
                ->where('current_room_id', $room->id)
                ->count();
        }
        return view('livewire.rooms', [
            'rooms' => $rooms,
        ]);
    }
}
