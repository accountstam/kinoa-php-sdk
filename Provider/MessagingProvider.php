<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class MessagingProvider
{
    private $client;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
    }

    public function getInbox($playerId)
    {
        return $this->client->get("/players/{$playerId}/messages")->getBody()->getContents();
    }

    public function sendMessage($fromPlayerId, $toPlayerId, $message)
    {
        return $this->client->post("/players/{$fromPlayerId}/messages", [
            'json' => ['to' => $toPlayerId, 'message' => $message]
        ])->getBody()->getContents();
    }

    public function ackMessage($playerId, $msgId)
    {
        return $this->client->post("/players/{$playerId}/messages/{$msgId}/ack")
            ->getBody()->getContents();
    }
}
