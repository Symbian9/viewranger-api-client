<?php

namespace Symm\ViewRangerClient\Tests;

use GuzzleHttp\Adapter\MockAdapter;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use Symm\ViewRangerClient\ViewRangerClient;

/**
 * ViewRangerClient
 */
final class ViewRangerClientTest extends \PHPUnit_Framework_TestCase
{
    private $apiKey = 'TEST_API_KEY';

    /**
     * @var ViewRangerClient
     */
    private $client;

    /**
     * @var MockAdapter
     */
    private $mock;

    public function setUp()
    {
        $this->mock = new MockAdapter();
        $this->client = ViewRangerClient::create($this->apiKey, ['adapter' => $this->mock]);
    }

    public function testItCanBeConstructedUsingAFactory()
    {
        $client = ViewRangerClient::create($this->apiKey);
        $this->assertInstanceOf('Symm\ViewRangerClient\ViewRangerClient', $client);
    }

    public function testItShouldReturnTheLastBeaconForAUser()
    {
        $this->mock->setResponse(
            new Response(200, [], Stream::factory(file_get_contents(__DIR__ . '/fixtures/beacon.json')))
        );
        $lastBeacon = $this->client->getLastBeaconPosition('user@example.com', 1234);

        $this->assertInstanceOf('Symm\ViewRangerClient\Model\Beacon', $lastBeacon);
    }

    public function testItShouldReturnACollectionOfBeacons()
    {
        $this->mock->setResponse(
            new Response(200, [], Stream::factory(file_get_contents(__DIR__ . '/fixtures/beacons.json')))
        );

        $beacons = $this->client->getBeaconPositions('user@example.com', 1234, new \DateTime('-14 days'), new \DateTime(), 14);

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $beacons);

        foreach ($beacons as $beacon) {
            $this->assertInstanceOf('Symm\ViewRangerClient\Model\Beacon', $beacon);
        }
    }

    public function testItShouldThrowAnExceptionWhenAnApiErrorIsReturned()
    {
        $this->mock->setResponse(
            new Response(200, [], Stream::factory(file_get_contents(__DIR__ . '/fixtures/invalidApiKey.json')))
        );

        $this->setExpectedException('Symm\ViewRangerClient\Exception\ViewRangerClientException');
        $this->client->getLastBeaconPosition('user@example.com', 1234);
    }
} 