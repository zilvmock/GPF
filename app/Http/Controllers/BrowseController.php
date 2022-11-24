<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    function showGames()
    {
        $games = Game::select('id', 'name', 'slug', 'genres', 'summary', 'cover')->get();
        $rooms = Room::select('id', 'game_id')->get();

        /* sort by room count and add room count to each game */
        $games = $games->sortByDesc(function ($game) use ($rooms) {
            $game->room_count = $rooms->where('game_id', $game->id)->count();
            return $game->room_count;
        });

        return view('browse', [
            'games' => $games->paginate(24),
        ]);
    }

    function showRooms(Request $request)
    {
        $game_id = $request->id;
        $game_slug = $request->game;
        $game = Game::select('name', 'genres', 'summary')->where('id', $game_id)->first();
        $rooms = Room::select('id', 'owner_id', 'title', 'slug', 'size', 'is_locked')
            ->where('game_id', $game_id)->get();

        return view('browse-game-rooms', [
            'rooms' => $rooms,
            'game' => $game,
            'game_slug' => $game_slug,
            'game_id' => $game_id,
        ]);
    }
}
