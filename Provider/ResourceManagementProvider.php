<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class ResourceManagementProvider
{
    private $client;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
    }

    public function getResourceBalances($playerId)
    {
        return $this->client->get("/players/{$playerId}/resources")->getBody()->getContents();
    }

    public function spendResource($playerId, $payload)
    {
        return $this->client->post("/players/{$playerId}/resources/spend", [
            'json' => $payload
        ])->getBody()->getContents();
    }

    public function earnResource($playerId, $payload)
    {
        return $this->client->post("/players/{$playerId}/resources/earn", [
            'json' => $payload
        ])->getBody()->getContents();
    }
}
