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
                'sender_id' => 1,
                'receiver_id' => 2,
                'podcast_id' => 1,
                'content' => 'John Doe just posted a new podcast!',
                'is_seen' => false,
            ],
        ]);
    }
}
