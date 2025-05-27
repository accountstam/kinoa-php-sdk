<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class FeaturesSettingsProvider
{
    private $client;
    private $gameId;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
        $this->gameId = $kc->getGameId();
    }

    public function getFeatureFlags()
    {
        return $this->client->get("/games/{$this->gameId}/features")->getBody()->getContents();
    }

    public function updateFeatureSettings($settings)
    {
        return $this->client->post("/games/{$this->gameId}/features/settings", [
            'json' => $settings
        ])->getBody()->getContents();
    }
}
