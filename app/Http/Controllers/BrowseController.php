<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    function showGames()
    {
        $games = Game::select('id', 'title', 'slug', 'genre', 'description')->get();
        return view('browse', [
            'games' => $games,
        ]);
    }

    function showRooms(Request $request)
    {
        $game_id = $request->id;
        $game_slug = $request->game;
        $rooms = Room::select('id', 'owner_id', 'title', 'slug', 'size', 'is_locked')->where('game_id', $game_id)->get();

        return view('browse-game-rooms', [
            'rooms' => $rooms,
            'game_slug' => $game_slug,
            'game_id' => $game_id,
        ]);
    }
}
