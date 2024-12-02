<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PodcastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('podcasters')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Charlie Davis',
                'email' => 'charlie@example.com',
                'password' => Hash::make('password'),
                'image' => null,
                'google_id' => null,
                'facebook_id' => null,
                'email_verified_at' => now()
            ],
        ]);
    }
}
