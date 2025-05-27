<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class P2PEventsProvider
{
    private $client;
    private $gameId;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
        $this->gameId = $kc->getGameId();
    }

    public function sendP2PEvent($payload)
    {
        return $this->client->post("/games/{$this->gameId}/p2p-events", [
            'json' => $payload
        ])->getBody()->getContents();
    }

    public function getP2PEventHistory()
    {
        return $this->client->get("/games/{$this->gameId}/p2p-events")->getBody()->getContents();
    }
}
