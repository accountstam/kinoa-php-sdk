<?php
namespace Kinoa;

use GuzzleHttp\Client;

class KinoaClient
{
    private $client;
    private $gameId;
    private $token;

    public $player;
    public $events;
    public $messaging;
    public $bundles;
    public $features;
    public $p2p;
    public $payments;
    public $resources;

    public function __construct($gameId, $token, $baseUrl = 'https://api.kinoa.io/api/v3')
    {
        $this->gameId = $gameId;
        $this->token = $token;
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);
        $this->player    = new Provider\PlayerDataProvider($this);
        $this->events    = new Provider\GameEventsProvider($this);
        $this->messaging = new Provider\MessagingProvider($this);
        $this->bundles   = new Provider\BundlesProvider($this);
        $this->features  = new Provider\FeaturesSettingsProvider($this);
        $this->p2p       = new Provider\P2PEventsProvider($this);
        $this->payments  = new Provider\PaymentVerificationProvider($this);
        $this->resources = new Provider\ResourceManagementProvider($this);
    }

    public function getHttpClient()
    {
        return $this->client;
    }
    public function getGameId()
    {
        return $this->gameId;
    }
    public function getToken()
    {
        return $this->token;
    }
}
