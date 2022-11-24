<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::factory()->times(config('dbSeed.games'))->create();
        /* work around doing multiple seeds */
        Artisan::call('cache:clear');
    }
}
