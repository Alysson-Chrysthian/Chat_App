<?php

use App\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat
        )
    ),
    8080
);

echo "Server started";

$server->run();