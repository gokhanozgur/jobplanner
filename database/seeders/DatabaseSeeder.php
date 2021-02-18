<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                'name' => "DEV".$i,
                'performance' => $i,
                'email' => 'dev'.$i.'@developer.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
            ]);
        }

    }
}
