<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class BundlesProvider
{
    private $client;
    private $gameId;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
        $this->gameId = $kc->getGameId();
    }

    public function getAvailableBundles()
    {
        return $this->client->get("/games/{$this->gameId}/bundles")->getBody()->getContents();
    }

    public function downloadBundle($bundleId)
    {
        return $this->client->post("/games/{$this->gameId}/bundles/{$bundleId}/download")
            ->getBody()->getContents();
    }
}
