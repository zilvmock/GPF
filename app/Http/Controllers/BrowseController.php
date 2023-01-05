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
        $allGames = $games;
        $searchGenres = explode(',', $request->genres);
        $searchGenres = array_map('trim', $searchGenres);

        if ($request->has('search')) {
            $search = strip_tags(clean($request->search));
            $games = Game::filter($search, $searchGenres)->get();
        }

        $games = $games->sortByDesc(function ($game) {
            $game->room_count = Room::select('game_id')->where('game_id', $game->id)->count();
            return $game->room_count;
        });

        $allGenres = $allGames->pluck('genres')->map(function ($item, $key) {
            return explode(',', $item);
        })->flatten();
        $allGenres = $allGenres->map(function ($item, $key) {
            return trim($item);
        })->unique()->sort();

        return view('browse', [
            'games' => $games->paginate(24),
            'allGenres' => $allGenres,
            'searchGenres' => $searchGenres,
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
