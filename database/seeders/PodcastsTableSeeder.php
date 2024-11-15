<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PodcastsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('podcasts')->insert([
            [
                'title' => '5.0.2 Reboot',
                'description' => 'Life is long. A series of chapters as you move from one scene to the next. Childhood, becoming a young adult, possibly a parent at some point, and more.',
                'audio' => 'https://redirect.zencastr.com/r/episode/6588d4954f8a1359826dd30e/audio-files/6532b7d6e7ebb15eea49bc9a/abf5fe8c-1d7e-4fed-84bf-90898fad537f.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/067ce17b-71de-4b50-a92c-51310e165916.png',
                'duration' => 3600,
                'category_id' => 1,
                'podcaster_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '5.0.1 Voice',
                'description' => 'What do you do when your voice gains an audience? Do you rattle cages or open doors? That is what we talk about in this episode.',
                'audio' => 'https://redirect.zencastr.com/r/episode/6549293a29b48dd281bf4a56/audio-files/6532b7d6e7ebb15eea49bc9a/c0b60a16-6fd7-47aa-bea5-dcca4c8a2ebf.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/25689dbf-032c-4140-ad82-efa62434f87f.jpg',
                'duration' => 2700,
                'category_id' => 2,
                'podcaster_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '4.0.1 Faith',
                'description' => 'How does our Faith drive us? Do you have Faith in yourself and your abilities, and how do you know you are on the right path?',
                'audio' => 'https://redirect.zencastr.com/r/episode/6532cb868cc7ba4445bcb497/audio-files/6532b7d6e7ebb15eea49bc9a/fb63bcff-267a-42cc-8280-191adcc332bf.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/490ec0d0-da78-449f-aa8b-f0b831bf1424.jpg',
                'duration' => 2700,
                'category_id' => 2,
                'podcaster_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '3.0.2 Space',
                'description' => "In this episode of This Developer's Life we ask the hard questions about space. Why aren't we on Mars? Why haven't we gone back to the moon?",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532cc0d0696e743f8e1cc8d/audio-files/6532b7d6e7ebb15eea49bc9a/c9c22f4c-5633-4ae5-b220-5cef5bb22089.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/5bc4896a-7817-488d-9f14-f38321e998c4.jpg',
                'duration' => 2700,
                'category_id' => 3,
                'podcaster_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '2.0.9 Drama',
                'description' => "Where does drama come from? How do we react to it? How much drama can be created by simple semicolon? This week we explore The Great Semicolon Affair.",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532cc80d46b6e653c2201f6/audio-files/6532b7d6e7ebb15eea49bc9a/9add596f-f36a-454d-9cf4-64f25e20f152.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/2478db59-2f47-49c6-90e6-a3ff3e6f0eaa.jpg',
                'duration' => 3300,
                'category_id' => 4,
                'podcaster_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '2.0.8 Learn',
                'description' => "How many empty brain cells do you have in your head? How capable are you of learning something completely new, and retaining what you already know?",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532ccaad46b6e58152201fe/audio-files/6532b7d6e7ebb15eea49bc9a/babe2d0f-fa87-41b4-91da-4a7472f906b0.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/96ba2abf-7c49-4aac-aa23-f7ecfe2b822a.jpg',
                'duration' => 2700,
                'category_id' => 5,
                'podcaster_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '2.0.7 Dinosaurs',
                'description' => "You're so old! What a dinosaur! You're using old software and old languages to do old things! Or are you?",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532ccd7c30c4fb1c8c07f19/audio-files/6532b7d6e7ebb15eea49bc9a/788df67b-db9d-4032-b58c-a3429239220a.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/5cb9836e-d61c-44ca-a44b-3370013554e2.jpg',
                'duration' => 4300,
                'category_id' => 1,
                'podcaster_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '2.0.5 Typo',
                'description' => "Who cares about typefaces and why should you? Well, these guys do and you should start caring.",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532cd298cc7baa0d0bcb4ed/audio-files/6532b7d6e7ebb15eea49bc9a/49e56df0-3859-42c3-906f-7e037cbd94ad.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/13f03261-ed6c-4a18-921c-b0fa8876a957.jpg',
                'duration' => 3500,
                'category_id' => 1,
                'podcaster_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '2.0.4 Taste',
                'description' => "What is taste? What is style? Do you have it? Scott and Rob have no idea what it is or how to get it - but they know it's important.",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532cd4f50d249bf852d62d0/audio-files/6532b7d6e7ebb15eea49bc9a/1332d093-23a6-42a7-b38b-5c39c95c3a9d.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/53ee32ab-563a-49ff-8986-2a48bfe62ad6.jpg',
                'duration' => 6600,
                'category_id' => 4,
                'podcaster_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '2.0.3 Education',
                'description' => "Scott and Rob discuss the value of a degree - and talk to two developers who used their passion to pull them through school and into their careers.",
                'audio' => 'https://redirect.zencastr.com/r/episode/6532cd7a0696e7308ee1ccb7/audio-files/6532b7d6e7ebb15eea49bc9a/1352bb9d-21fa-489c-8b96-316647d36031.mp3',
                'image' => 'https://media.zencastr.com/image-files/6532b7d6e7ebb15eea49bc9a/f872c00a-251c-48ca-b519-9f806f740095.jpg',
                'duration' => 5700,
                'category_id' => 5,
                'podcaster_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
