<?php
namespace App\Service;

use App\Service\Traits\ConsumeExternalService;

class OmdbService
{
    use ConsumeExternalService;

    public function searchByTitle(array $data): array
    {
        $queryParams = [
            's'    => $data['name'],
            'page' => $data['page'],
        ];

        $response = $this->performRequestQuery($queryParams);

        return $response->toArray();
    }

    public function showByImdbId(string $imdb_id): array
    {
        $queryParams = [
            'i' => $imdb_id
        ];

        $response = $this->performRequestQuery($queryParams);

        return $response->toArray();
    }
}