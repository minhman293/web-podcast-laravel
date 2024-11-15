<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            [
                'content' => 'New episode released!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 1,
                'podcaster_id' => 1,
            ],
            [
                'content' => 'New episode released!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 2,
                'podcaster_id' => 2,
            ],
            [
                'content' => 'New episode released!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 3,
                'podcaster_id' => 3,
            ],
            [
                'content' => 'Someone commented on your podcast!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 4,
                'podcaster_id' => 4,
            ],
            [
                'content' => 'New episode released!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 5,
                'podcaster_id' => 5,
            ],
        ]);
    }
}
