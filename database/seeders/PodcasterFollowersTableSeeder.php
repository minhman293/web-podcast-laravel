<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PodcasterFollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('podcaster_followers')->insert([
            [
                'podcaster_id' => 1,
                'follower_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'podcaster_id' => 1,
                'follower_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'podcaster_id' => 2,
                'follower_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'podcaster_id' => 3,
                'follower_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'podcaster_id' => 3,
                'follower_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
