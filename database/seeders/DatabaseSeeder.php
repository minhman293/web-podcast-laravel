<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\Notification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            PodcastersTableSeeder::class,
            PodcastsTableSeeder::class,
            NotificationsTableSeeder::class,
            CommentsTableSeeder::class,
            PodcasterFollowersTableSeeder::class,
        ]);
    }
}
