<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'content' => 'Great episode!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 1,
                'podcaster_id' => 1,
            ],
            [
                'content' => 'Very informative.',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 2,
                'podcaster_id' => 2,
            ],
            [
                'content' => 'Loved the guest speaker.',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 3,
                'podcaster_id' => 3,
            ],
            [
                'content' => 'Looking forward to the next episode.',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 4,
                'podcaster_id' => 4,
            ],
            [
                'content' => 'This was really helpful, thanks!',
                'created_at' => now(),
                'updated_at' => now(),
                'podcast_id' => 5,
                'podcaster_id' => 5,
            ],
        ]);
    }
}
