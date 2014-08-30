<?php

namespace Symm\ViewRangerClient\Tests\Model;

use Symm\ViewRangerClient\Model\Point;

/**
 * PointTest
 */
final class PointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Point
     */
    private $point;

    public function setup()
    {
        $this->point = new Point(53.347716, -1.813326);
    }

    public function testItCanBeInstantiated()
    {
        $this->assertInstanceOf('Symm\ViewRangerClient\Model\Point', $this->point);
    }

    public function testItShouldReturnTheLatitude()
    {
        $this->assertEquals(53.347716, $this->point->getLatitude());
    }

    public function testItShouldReturnTheLongitude()
    {
        $this->assertEquals(-1.813326, $this->point->getLongitude());
    }

    public function testItCanBeRepresentedAsAString()
    {
        $this->assertEquals('53.347716,-1.813326', $this->point->__toString());
    }
}