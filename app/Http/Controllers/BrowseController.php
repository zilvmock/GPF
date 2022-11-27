<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    function showGames(Request $request)
    {
        $games = Game::select('id', 'name', 'slug', 'genres', 'summary', 'cover')->get();

        if ($request->has('search')) {
            $games = Game::filter($request->search)->get();
        }

        /* sort by room count and add room count to each game */
        $games = $games->sortByDesc(function ($game) {
            $game->room_count = Room::select('game_id')->where('game_id', $game->id)->count();
            return $game->room_count;
        });

        return view('browse', [
            'games' => $games->paginate(24),
            'searchValue' => $request->search ?? ''
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
