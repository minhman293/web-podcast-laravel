<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\App;
use App\WebSocket\WebSocketServer;

class WebSocketCommand extends Command
{
    protected $signature = 'ws:serve';
    protected $description = 'Run the WebSocket server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $HOST = env('WS_URL', 'localhost');
        $PORT = env('WS_PORT', 8080);
        $this->info("Starting WebSocket server on port $PORT...");

        $server = new App($HOST, $PORT);
        $server->route('/ws', new WebSocketServer, ['*']);
        $server->run();
    }
}
