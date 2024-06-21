<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\MovieSchedule::create([
        //         'movies_id' => 1,
        //         'theaters_id' => 1,
        //         'show_start' => Carbon::parse('10:00:00')->format('H:i'),
        //         'show_end' => Carbon::parse('12:00:00')->format('H:i'),
        //         'status_approval' => null,
        //         'tanggal_approval' => null
        //     ]);
    }
}
