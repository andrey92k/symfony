<?php
namespace App\Service;

use App\Service\Traits\ConsumeExternalService;

class ThemoviedbService
{
    use ConsumeExternalService;

    public function searchByTitle(array $data): array
    {
        $uri = 'search/movie';

        $queryParams = [
            'query'   => $data['name'],
            'page'    => $data['page'],
            'api_key' => $this->secret
        ];

        $response = $this->performRequestQuery($queryParams, $uri);

        return $response->toArray();
    }

    public function showById(int $movie_id): array
    {
        $uri = 'movie/' . $movie_id;

        $queryParams = [
            'api_key' => $this->secret
        ];

        $response = $this->performRequestQuery($queryParams, $uri);

        return $response->toArray();
    }
}