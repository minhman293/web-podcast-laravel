<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\App;
use App\WebSocket\WebSocketServer;

class WebSocketCommand extends Command
{
    protected $signature = 'websocket:serve';
    protected $description = 'Run the WebSocket server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting WebSocket server...');

        // $server = new App(env('WS_URL'), env('WS_PORT', 8080));
        $server = new App('localhost', 8080);
        $server->route('/ws', new WebSocketServer, ['*']);
        $server->run();
    }
}
