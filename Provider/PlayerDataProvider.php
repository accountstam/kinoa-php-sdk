<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class PlayerDataProvider
{
    private $client;
    private $gameId;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
        $this->gameId = $kc->getGameId();
    }

    public function getProfile($playerId)
    {
        return $this->client->get("/players/{$playerId}/profile")->getBody()->getContents();
    }

    public function updateProfile($playerId, $profileData)
    {
        return $this->client->post("/players/{$playerId}/profile", [
            'json' => $profileData
        ])->getBody()->getContents();
    }

    public function getInventory($playerId)
    {
        return $this->client->get("/players/{$playerId}/inventory")->getBody()->getContents();
    }

    public function addToInventory($playerId, $item)
    {
        return $this->client->post("/players/{$playerId}/inventory", [
            'json' => $item
        ])->getBody()->getContents();
    }
}
