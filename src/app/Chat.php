<?php

namespace App;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class Chat implements MessageComponentInterface {

    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: ({$conn->resourceId})";
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        foreach ($this->clients as $client) {
            if ($conn !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection closed";
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        echo "An error ocurred {$e->getMessage()}";
        $conn->close();
    }

}