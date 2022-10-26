<?php

namespace App\Service\Traits;

use Symfony\Contracts\HttpClient\HttpClientInterface;

trait ConsumeExternalService
{
    private $baseUri, $secret;

    public function __construct(private HttpClientInterface $client)
    {
        $this->baseUri = $_ENV['OMDBAPI_URI'];
        $this->secret = $_ENV['OMDBAPI_SECRET'];
    }

    public function performRequestQuery($queryParams = [])
    {
        $response = $this->client->request(
            'GET',
            $this->baseUri . '/?apikey=' . $this->secret,
            [
                'query' => $queryParams
            ]
        );

        return $response;
    }
}
