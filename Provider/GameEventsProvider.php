<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class GameEventsProvider
{
    private $client;
    private $gameId;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
        $this->gameId = $kc->getGameId();
    }

    public function sendGameEvent($eventType, $payload)
    {
        return $this->client->post("/games/{$this->gameId}/events", [
            'json' => ['type' => $eventType, 'payload' => $payload]
        ])->getBody()->getContents();
    }

    public function getEventHistory($playerId = null)
    {
        $url = "/games/{$this->gameId}/events";
        if ($playerId) $url .= "?player_id={$playerId}";
        return $this->client->get($url)->getBody()->getContents();
    }
}
