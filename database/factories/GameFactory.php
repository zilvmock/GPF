<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use MarcReichel\IGDBLaravel\Models\Game;

/**
 * @extends Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    private int $iterNum = 0;

    public function definition(): array
    {
        if (Cache::has('games')) {
            $multiplayerGames = Cache::get('games');
            $this->iterNum++;
        } else {
            $multiplayerGames = $this->getData(collect(), config('dbSeed.games'));
            $this->iterNum = 0;
        }

        if ($multiplayerGames) {
            return [
                'id' => $multiplayerGames[$this->iterNum]['id'],
                'name' => $multiplayerGames[$this->iterNum]['name'],
                'slug' => $multiplayerGames[$this->iterNum]['slug'],
                'genres' => $multiplayerGames[$this->iterNum]['genres'],
                'summary' => $multiplayerGames[$this->iterNum]['summary'],
                'cover' => $multiplayerGames[$this->iterNum]['cover'],
            ];
        } else {
            return throw new \Exception('Could not get games');
        }
    }

    private function getData($totalGames, $amount, $offset = 0)
    {
        /* get max amount of games with relationships */
        $totalGames->push(Game::offset($offset)
            ->take($amount) // 500 is one request limit
            ->select('id', 'name', 'slug', 'genres', 'summary', 'cover')
            ->whereNotNull('multiplayer_modes')
            ->with(['cover' => 'url',
                'genres' => 'name',
                'multiplayer_modes' => ['campaigncoop', 'lancoop', 'onlinecoop', 'dropin']
            ])
            ->where('multiplayer_modes.campaigncoop', '=', true)
            ->orWhere('multiplayer_modes.lancoop', '=', true)
            ->orWhere('multiplayer_modes.onlinecoop', '=', true)
            ->orWhere('multiplayer_modes.dropin', '=', true)
            ->get()
        );

        // TODO: deprecated
        /* sort out games that have proper multiplayer support */
//            foreach($games as $game){
//                if ($game->multiplayer_modes)
//                    if (array_key_exists('campaigncoop', $game->multiplayer_modes[0])
//                        && $game->multiplayer_modes[0]['campaigncoop'] === true
//                        || array_key_exists('lancoop', $game->multiplayer_modes[0])
//                        && $game->multiplayer_modes[0]['lancoop'] === true
//                        || array_key_exists('onlinecoop', $game->multiplayer_modes[0])
//                        && $game->multiplayer_modes[0]['onlinecoop'] === true) {
//                        $totalGames->push($game);
//                    }
//            }

        if (count($totalGames->flatten()) < $amount) {
            return $this->getData($totalGames, $amount, $offset + $amount);
        }

        $totalGames = $totalGames->flatten();

        /* extract proper needed values */
        foreach ($totalGames as $game) {
            if ($game['genres'])
                if (!is_string($game['genres'])) {
                    foreach ($game['genres'] as $genre) {
                        $genres[] = $genre['name'];
                        if (count($genres) > 3) {
                            break;
                        }
                    }
                    $game['genres'] = implode(', ', $genres ?? []);
                    $genres = [];
                } else {
                    $game['genres'] = $game['genres'][0];
                }
            if ($game['cover'])
                if (!is_string($game['cover'])) {
                    $game['cover'] = str_replace('thumb', '720p', $game['cover']['url']);
                }
        }

        /* remove duplicates (just in case there are any) */
        $totalGames = $totalGames->unique('name');

        /* assign proper values */
        $totalGames = $totalGames->map(function ($game) {
            return [
                'id' => Str::uuid(),
                'name' => $game['name'],
                'slug' => $game['slug'],
                'genres' => $game['genres'],
                'summary' => $game['summary'],
                'cover' => $game['cover'],
            ];
        });

        /* ensure all fields are with data */
        $totalGames = $totalGames->filter(function ($game) {
            return $game['name'] !== null
                && $game['slug'] !== null
                && $game['genres'] !== null
                && $game['summary'] !== null
                && $game['cover'] !== null;
        });

        Cache::put('games', $totalGames, now()->addMinutes(5));

        return $totalGames;
    }
}
