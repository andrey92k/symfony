<?php
namespace App\Service;

use App\Service\Traits\ConsumeExternalService;

class OmdbService
{
    use ConsumeExternalService;

    public function searchByTitle(array $data): array
    {
        $queryParams = [
            's'      => $data['name'],
            'page'   => $data['page'],
            'apikey' => $this->secret
        ];

        $response = $this->performRequestQuery($queryParams);

        return $response->toArray();
    }

    public function showById(string $imdb_id): array
    {
        $queryParams = [
            'i' => $imdb_id,
            'apikey' => $this->secret
        ];

        $response = $this->performRequestQuery($queryParams);

        return $response->toArray();
    }
}