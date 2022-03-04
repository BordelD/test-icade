<?php

namespace App\Client;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FootballClient
{
    public function __construct(private HttpClientInterface $apiFootball)
    {
    }

    public function getMatches(int $leagueId, int $season): string
    {
        return $this->getApiContent(
            Request::METHOD_GET,
            'v3/fixtures',
            [
                'query' => [
                    'league' => $leagueId,
                    'season' => $season,
                ]
            ]
        );
    }

    public function getFixtureDetails(string $fixtureId): string
    {
        return $this->getApiContent(
            Request::METHOD_GET,
            'v3/fixtures/events',
            [
                'query' => [
                    'fixture' => $fixtureId
                ]
            ]
        );
    }

    private function getApiContent(string $method, string $url, array $options): string
    {
        $response = $this->apiFootball->request($method, $url, $options);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new BadRequestHttpException($response->getContent()); // @todo format response
        }

        return $response->getContent();
    }
}
