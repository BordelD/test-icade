<?php

namespace Manager;

use App\Client\FootballClient;
use App\Manager\FootballManager;
use App\Model\Fixture;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FootballManagerTest  extends KernelTestCase
{
    private FootballManager $manager;
    private FootballClient|MockObject $client;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $serializer = $container->get(SerializerInterface::class);

        $this->client = self::createMock(FootballClient::class);

        $this->manager = new FootballManager($serializer, $this->client);
    }

    public function testGetFixtures()
    {
        $this->client
            ->method('getMatches')
            ->willReturn('{"get":"fixtures","parameters":{"league":"61","season":"2021"},"errors":[],"results":380,"paging":{"current":1,"total":1},"response":[{"fixture":{"id":718351,"referee":"F. Batta","timezone":"UTC","date":"2021-08-08T13:00:00+00:00","timestamp":1628427600,"periods":{"first":1628427600,"second":1628431200},"venue":{"id":638,"name":"Stade Matmut-Atlantique","city":"Bordeaux"},"status":{"long":"Match Finished","short":"FT","elapsed":90}},"league":{"id":61,"name":"Ligue 1","country":"France","logo":"https:\/\/media.api-sports.io\/football\/leagues\/61.png","flag":"https:\/\/media.api-sports.io\/flags\/fr.svg","season":2021,"round":"Regular Season - 1"},"teams":{"home":{"id":78,"name":"Bordeaux","logo":"https:\/\/media.api-sports.io\/football\/teams\/78.png","winner":false},"away":{"id":99,"name":"Clermont Foot","logo":"https:\/\/media.api-sports.io\/football\/teams\/99.png","winner":true}},"goals":{"home":0,"away":2},"score":{"halftime":{"home":0,"away":0},"fulltime":{"home":0,"away":2},"extratime":{"home":null,"away":null},"penalty":{"home":null,"away":null}}}]}');

        $content = $this->manager->getFixtures(42, 42);

        self::assertCount(1, $content);
        self::assertInstanceOf(Fixture::class, $content[0]);
        self::assertEquals(718351, $content[0]->fixture['id']);
    }
}
