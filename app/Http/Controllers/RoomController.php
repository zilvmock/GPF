<?php

namespace App\Http\Controllers;

use App\Events\CreateRoomEvent;
use App\Events\DeleteRoomEvent;
use App\Events\GlobalLeaveRoomEvent;
use App\Events\JoinRoomEvent;
use App\Events\LeaveRoomEvent;
use App\Events\UpdateRoomsEvent;
use App\Models\Game;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function showCreateNewRoom(Request $request)
    {
        $gameId = $request->id;
        $game = Game::select('id', 'slug')->where('id', $gameId)->first();

        return view('create-new-room', [
            'game' => $game,
        ]);
    }

    public function storeCreatedRoom(Request $request)
    {
        $game_id = $request->game;
        $owner_id = auth()->user()->id;
        $room_title = $request->title;

        $fieldsToVerify = [
            'title' => strip_tags(clean($room_title)),
        ];

        $validator = Validator::make($fieldsToVerify, [
            'title' => ['required', 'max:255'],
        ], [
            'required' => 'The :attribute field can not be blank!',
        ]);

        if ($validator->passes()) {
            $room_id = DB::table('rooms')->insertGetId([
                'owner_id' => $owner_id,
                'game_id' => $game_id,
                'title' => $fieldsToVerify['title'],
                'slug' => Str::slug($fieldsToVerify['title']),
                'size' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            auth()->user()->current_room_id = $room_id;
            auth()->user()->save();

            broadcast(new UpdateRoomsEvent());

            return redirect()->route('show_room', [
                'game' => Game::where('id', $game_id)->first()->slug,
                'id' => $game_id,
                'room' => $room_id,
            ]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function showRoom(Request $request)
    {
        $game_slug = $request->game;
        $game_id = $request->id;
        $room_id = $request->room;

        $owner = Room::where('id', $room_id)->first()->user;

        return view('room-view', [
            'game' => $game_slug,
            'id' => $game_id,
            'room' => $room_id,
            'owner' => $owner,
        ]);
    }

    public function joinRoom(Request $request)
    {
        $room_id = $request->room;
        $game_slug = $request->game;
        $game_id = $request->id;

        $user = auth()->user();

        if ($user->current_room_id != 0) {
            return redirect()->route('show_room', [
                'game' => $game_slug,
                'id' => $game_id,
                'room' => $room_id,
            ]);
        }

        $user->current_room_id = $room_id;
        $user->save();

        broadcast(new JoinRoomEvent($room_id));
        broadcast(new UpdateRoomsEvent());
        return redirect()->route('show_room', [
            'game' => $game_slug,
            'id' => $game_id,
            'room' => $room_id,
        ]);
    }

    public function leaveRoom(Request $request)
    {
        $room_id = $request->room;
        $game_slug = $request->game;
        $game_id = $request->id;

        $user = auth()->user();

        $user->current_room_id = 0;
        $user->save();

        broadcast(new LeaveRoomEvent($room_id));
        broadcast(new UpdateRoomsEvent());
        return redirect()->route('rooms', [
            'game' => $game_slug,
            'id' => $game_id,
        ]);
    }

    public function deleteRoom(Request $request)
    {
        $room_id = $request->room;
        $game_slug = $request->game;
        $game_id = $request->id;

        User::where('current_room_id', $room_id)->update([
            'current_room_id' => 0,
        ]);
        Room::where('id', $room_id)->delete();
        Message::where('room_id', $room_id)->delete();

        broadcast(new DeleteRoomEvent($room_id));
        broadcast(new UpdateRoomsEvent());
        return redirect()->route('rooms', [
            'game' => $game_slug,
            'id' => $game_id,
        ]);
    }
}
