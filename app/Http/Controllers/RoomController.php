<?php

namespace App\Http\Controllers;

use App\Events\DeleteRoomEvent;
use App\Events\JoinRoomEvent;
use App\Events\KickFromRoomEvent;
use App\Events\LeaveRoomEvent;
use App\Events\LockRoomEvent;
use App\Events\UpdateOwnerEvent;
use App\Events\UpdateRoomsEvent;
use App\Models\Game;
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

        if (auth()->user()->current_room_id != null) {
            return back()->with('error', 'You cannot create a new room while you are in another room!');
        }

        return view('create-new-room', [
            'game' => $game,
        ]);
    }

    public function storeCreatedRoom(Request $request)
    {
        $game_id = $request->game;
        $owner_id = auth()->user()->id;
        $room_title = $request->title;
        $room_size = $request->size;

        $fieldsToVerify = [
            'title' => strip_tags(clean($room_title)),
            'size' => strip_tags(clean($room_size)),
        ];

        $validator = Validator::make($fieldsToVerify, [
            'title' => ['required', 'max:128'],
            'size' => ['required', 'numeric', 'min:2', 'max:16'],
        ], [
            'required' => 'The :attribute field can not be blank!',
        ]);

        if ($validator->passes()) {
             $roomId = Room::insertGetId([
                 'owner_id' => $owner_id,
                 'game_id' => $game_id,
                 'title' => $fieldsToVerify['title'],
                 'slug' => Str::slug($fieldsToVerify['title']),
                 'size' => $fieldsToVerify['size'],
                 'created_at' => now(),
                 'updated_at' => now(),
             ]);

            auth()->user()->current_room_id = $roomId;
            auth()->user()->save();

            broadcast(new UpdateRoomsEvent());

            return redirect()->route('show_room', [
                'game' => Game::where('id', $game_id)->first()->slug,
                'id' => $game_id,
                'room' => $roomId,
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

        $users_in_room = DB::table('users')->where('current_room_id', $room_id)->count();
        $room = Room::select('id', 'owner_id', 'title', 'size', 'is_locked')->where('id', $room_id)->first();
        if ($users_in_room >= $room->size && auth()->user()->current_room_id != $room_id) {
            return back()->with('warning', 'Room is full!');
        } elseif ($room->is_locked && auth()->user()->current_room_id != $room->id) {
            return back()->with('warning', 'Room is locked!');
        }

        return view('room-view', [
            'game' => $game_slug,
            'id' => $game_id,
            'room' => $room_id,
            'room_title' => $room->title,
            'room_lock' => $room->is_locked,
            'room_size' => $room->size,
        ]);
    }

    public function joinRoom(Request $request)
    {
        $room_id = $request->room;
        $game_slug = $request->game;
        $game_id = $request->id;

        $user = auth()->user();

        if ($user->current_room_id != null && $user->current_room_id == $room_id) {
            return redirect()->route('show_room', [
                'game' => $game_slug,
                'id' => $game_id,
                'room' => $room_id,
            ]);
        }

        $user->current_room_id = $room_id;
        $user->save();
        broadcast(new JoinRoomEvent($room_id, $user->username));

        // If the user is the owner of some room, then we need to assign new owner of that room.
        // If there is no other people in the room, then we need to delete that room.
        $room = Room::where('owner_id', $user->id)->first();
        if ($room) {
            $prev_owner = $room->user;
            $users = User::select('id', 'username')->where('current_room_id', $room->id)->get();
            if ($users->count() != 0) {
                $room->owner_id = $users[0]->id;
                $room->save();
                broadcast(new UpdateOwnerEvent($room->id, $prev_owner->username, $users[0]->username));
            } else {
                $room->delete();
                broadcast(new DeleteRoomEvent($room->id));
            }
        }

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

        $user->current_room_id = null;
        $user->save();

        broadcast(new LeaveRoomEvent($room_id, $user->username));
        broadcast(new UpdateRoomsEvent());

        return redirect()->route('rooms', [
            'game' => $game_slug,
            'id' => $game_id,
        ]);
    }

    public function kickFromRoom(Request $request)
    {
        $room_id = $request->room;
        $user_id = $request->user;

        $user = User::select('id', 'username', 'current_room_id')->where('id', $user_id)->first();
        $user->current_room_id = null;
        $user->save();

        broadcast(new KickFromRoomEvent($room_id, $user->username));
        broadcast(new UpdateRoomsEvent());
        return back()->with('success', 'User kicked from the room!');
    }

    public function deleteRoom(Request $request)
    {
        $room_id = $request->room;
        $game_slug = $request->game;
        $game_id = $request->id;

        User::where('current_room_id', $room_id)->update([
            'current_room_id' => null,
        ]);
        Room::where('id', $room_id)->delete();

        broadcast(new DeleteRoomEvent($room_id));
        broadcast(new UpdateRoomsEvent());
        return redirect()->route('rooms', [
            'game' => $game_slug,
            'id' => $game_id,
        ]);
    }

    public function lockRoom(Request $request)
    {
        $room_id = $request->room;
        $room = Room::where('id', $room_id)->first();
        $state = $room->is_locked;
        $state = !$state;
        $room->is_locked = $state;
        $room->save();
        broadcast(new LockRoomEvent($room_id));
        broadcast(new UpdateRoomsEvent());

        if ($room->is_locked) {
            return redirect()->back()->with('success', 'Room locked!');
        } else {
            return redirect()->back()->with('success', 'Room unlocked!');
        }
    }
}
