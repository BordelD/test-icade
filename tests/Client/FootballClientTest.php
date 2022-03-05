<?php

namespace Client;

use App\Client\FootballClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class FootballClientTest extends TestCase
{
    private FootballClient $footballClient;
    private MockHttpClient $mockClient;

    protected function setUp(): void
    {
        $this->mockClient = new MockHttpClient();
        $this->footballClient = new FootballClient($this->mockClient);
    }

    public function testGetMatches()
    {
        $mockResponse = new MockResponse('');
        $this->mockClient->setResponseFactory($mockResponse);

        $this->footballClient->getMatches(42, 42);

        self::assertSame('GET', $mockResponse->getRequestMethod());
        self::assertSame(['league' => 42, 'season' => 42], $mockResponse->getRequestOptions()['query']);
    }

    public function testGetMatchesShouldFail()
    {
        self::expectException(ServerException::class);

        $mockResponse = new MockResponse('', [
            'http_code' => 500
        ]);
        $this->mockClient->setResponseFactory($mockResponse);

        $this->footballClient->getMatches(42, 42);
    }

    public function testGetFixtureDetails()
    {
        $mockResponse = new MockResponse('');
        $this->mockClient->setResponseFactory($mockResponse);

        $this->footballClient->getFixtureDetails(42);

        self::assertSame('GET', $mockResponse->getRequestMethod());
        self::assertSame(['fixture' => '42'], $mockResponse->getRequestOptions()['query']);
    }
}
