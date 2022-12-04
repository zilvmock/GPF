<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(RoomsSeeder::class);
        $this->call(MessagesSeeder::class);

        $users = \App\Models\User::all(['id', 'current_room_id']);
        $rooms = \App\Models\Room::all(['id', 'owner_id']);
        foreach($rooms as $room) {
            $id = rand(1, count($users) - 1);
            $room->owner_id = $users[$id]->id;
            $users[$id]->current_room_id = $room->id;
            $users[$id]->save();
            $room->save();
        }
    }
}
