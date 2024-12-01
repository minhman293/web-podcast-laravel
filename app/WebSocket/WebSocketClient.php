<?php

namespace App\WebSocket;

use App\Models\Podcast;
use App\Models\Podcaster;
use App\Models\PodcasterFollower;
use App\Services\Notification\NotificationService;
use App\Services\Podcasts\PodcastService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use WebSocket\Client;

class WebSocketClient
{
    private Client $client;

    public function __construct()
    {
        // $this->client = new Client(env('WS_CLIENT', 'ws://localhost:8080/ws'));
        $userId = Auth::id();
        $this->client = new Client("ws://localhost:8080/ws?user_id=$userId");
    }

    public function send($data)
    {
        $this->client->send(json_encode($data));
        $this->client->close();
        // dd($data);
    }


    public function sendCommentNotification(Podcaster $sender, Podcaster $receiver, Podcast $podcast)
    {
        $messages = [
            [
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'podcast_id' => $podcast->id,
                'content' => $sender->name.' just commented on your podcast!',
                'is_seen' => false,
            ]
        ];

        $this->send($messages);
        $this->saveNotifications($messages);
    }

    public function sendNewPodcastNotification(Podcaster $sender, Podcast $podcast)
    {
        $followerIds = PodcasterFollower::where('podcaster_id', $sender->id)->get('follower_id')->pluck('follower_id');
        // $lastPodcast = app(PodcastService::class)->getLastPodCastByPodcasterId($sender->id);

        $messages = [];

        foreach ($followerIds as $followerId) {
            $messages[] = [
                'sender_id' => $sender->id,
                'receiver_id' => $followerId,
                // 'podcast_id' => $lastPodcast->id,
                'podcast_id' => $podcast->id,
                'content' => $sender->name . ' just posted a new podcast!',
                'is_seen' => false,
            ];
        }

        $this->send($messages);
        $this->saveNotifications($messages);
    }

    public function saveNotifications($notifications)
    {
        foreach ($notifications as $notification) {
            app(NotificationService::class)->create($notification);
        }
    }
}
