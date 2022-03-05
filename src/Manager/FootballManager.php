<?php

namespace App\Manager;

use App\Client\FootballClient;
use App\Model\Event\Event;
use App\Model\Fixture;
use App\Model\Response as FixtureResponse;
use App\Model\Event\Response as EventResponse;
use App\Model\Team\Response as TeamResponse;
use JMS\Serializer\SerializerInterface;

class FootballManager
{
    public function __construct(private SerializerInterface $serializer, private FootballClient $client)
    {
    }

    /**
     * @param int $leagueId
     * @param int $season
     *
     * @return Fixture[]
     */
    public function getFixtures(int $leagueId, int $season): array
    {
        $content = $this->client->getMatches($leagueId, $season);

        /** @var FixtureResponse $response */
        $response = $this->serializer->deserialize($content, FixtureResponse::class, 'json');

        return $response->response;
    }

    /**
     * @param int $fixtureId
     *
     * @return Event[]
     */
    public function getEvents(int $fixtureId): array
    {
        $content = $this->client->getFixtureDetails($fixtureId);

        /** @var EventResponse $response */
        $response = $this->serializer->deserialize($content, EventResponse::class, 'json');

        return $response->response;
    }

    public function searchTeam(string $search): array
    {
        $content = $this->client->searchTeam($search);

        /** @var TeamResponse $response */
        $response = $this->serializer->deserialize($content, TeamResponse::class, 'json');

        return $response->response;
    }
}
