<?php

namespace App\Client;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FootballClient
{
    public function __construct(private HttpClientInterface $apiFootball, private SerializerInterface $serializer)
    {
    }

    /**
     * @param int $leagueId
     * @param int $season
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     *
     * @todo deserialize object is life
     */
    public function getFixture(int $leagueId, int $season)
    {
        $response = $this->apiFootball->request(
            Request::METHOD_GET,
            'v3/fixtures',
            [
                'query' => [
                    'league' => $leagueId,
                    'season' => $season,
                ]
            ]
        );

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new BadRequestHttpException($response->getContent()); // @todo format response
        }

        return $this->serializer->deserialize($response->getContent(),\App\Model\Response::class, 'json');
    }
}
