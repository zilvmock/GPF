<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(config('dbSeed.users'))->create();
        User::create([
            'username' => 'naudotojas1',
            'email' => 'naudotojas1@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('naudotojas1'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'username' => 'naudotojas2',
            'email' => 'naudotojas2@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('naudotojas2'),
            'remember_token' => Str::random(10),
        ]);
    }
}
