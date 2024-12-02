<?php

namespace App\WebSocket;

use App\Models\PodcasterFollower;
use App\Services\Podcasters\PodcasterService;
use App\Services\Podcasts\PodcastService;
use Illuminate\Support\Facades\DB;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $queryParams = [];
        parse_str($conn->httpRequest->getUri()->getQuery(), $queryParams);

        $userId = $queryParams['user_id'] ?? null;

        if (!$userId) {
            // echo "NO USER ID";
            $conn->close();
            return;
        } 

        $conn->userId = $userId;

        $this->clients->attach($conn);

        echo "User ID $userId connected [socket id: $conn->resourceId]\n";
    }

    public function onMessage(ConnectionInterface $from, $msgs)
    {
        // echo "New message! $msgs\n";
        $data = json_decode($msgs, true);
        foreach ($data as $msg) {
            $this->send($msg);
        }
    }


    private function send($msg)
    {

        foreach ($this->clients as $client) {
            // echo json_encode($msg);
            if ($client->userId == $msg['receiver_id']) {
                $client->send(json_encode($msg));
                echo "Sent to $client->userId [socketId:$client->resourceId]";
            } 
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
