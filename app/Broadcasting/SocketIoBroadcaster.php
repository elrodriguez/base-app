<?php

namespace App\Broadcasting;

use GuzzleHttp\Client;

class SocketIoBroadcaster
{
    protected $client;
    protected $url;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = env('SOCKET_IO_SERVER', 'http://localhost:3000');
    }

    public function broadcast(array $channels, $event, array $payload = [])
    {
        foreach ($channels as $channel) {
            $this->client->post("{$this->url}/broadcast", [
                'json' => [
                    'channel' => $channel,
                    'event' => $event,
                    'data' => $payload,
                ]
            ]);
        }
    }
}
