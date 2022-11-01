<?php

namespace App\Service\Traits;

use Symfony\Contracts\HttpClient\HttpClientInterface;

trait ConsumeExternalService
{

    public function __construct(private $baseUri, private $secret, private HttpClientInterface $client)
    {
    }

    public function performRequestQuery($queryParams = [], $requestUrl = null)
    {
        if (isset ($requestUrl)) {
            $this->baseUri = $this->baseUri . $requestUrl;
        }

        $response = $this->client->request(
            'GET',
            $this->baseUri,
            [
                'query' => $queryParams
            ]
        );

        return $response;
    }
}
