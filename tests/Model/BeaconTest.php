<?php

namespace Symm\ViewRangerClient\Tests\Model;

use Symm\ViewRangerClient\Model\Beacon;
use Symm\ViewRangerClient\Model\Point;

/**
 * BeaconTest
 */
final class BeaconTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Beacon
     */
    private $beacon;

    public function setup()
    {
        $this->beacon = new Beacon(
            new Point(53.347716, -1.813326),
            new \DateTime(),
            461,
            5,
            269
        );
    }

    public function testItCanBeInstantiated()
    {
        $this->assertInstanceOf('Symm\ViewRangerClient\Model\Beacon', $this->beacon);
    }

    public function testItShouldReturnTheLocation()
    {
        $location = $this->beacon->getLocation();
        $this->assertInstanceOf('Symm\ViewRangerClient\Model\Point', $location);
    }

    public function testItShouldReturnTheDate()
    {
        $datetime = $this->beacon->getDateTime();
        $this->assertInstanceOf('\DateTime', $datetime);
    }

    public function testItShouldReturnTheAltitude()
    {
        $this->assertEquals(461, $this->beacon->getAltitude());
    }

    public function testItShouldReturnTheHeading()
    {
        $this->assertEquals(269, $this->beacon->getHeading());
    }

    public function testItShouldReturnTheSpeed()
    {
        $this->assertEquals(5, $this->beacon->getSpeed());
    }
} 