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
        try {
            Game::factory()->times(config('dbSeed.games'))->create();
        } catch (\Exception $e) {
            /* work around doing multiple seeds */
            Artisan::call('cache:clear');
        }
    }
}
