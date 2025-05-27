<?php
namespace Kinoa\Provider;

use Kinoa\KinoaClient;

class PaymentVerificationProvider
{
    private $client;

    public function __construct(KinoaClient $kc)
    {
        $this->client = $kc->getHttpClient();
    }

    public function verifyPayment($playerId, $receipt)
    {
        return $this->client->post("/players/{$playerId}/payments/verify", [
            'json' => ['receipt' => $receipt]
        ])->getBody()->getContents();
    }

    public function getPurchaseHistory($playerId)
    {
        return $this->client->get("/players/{$playerId}/payments")->getBody()->getContents();
    }
}
