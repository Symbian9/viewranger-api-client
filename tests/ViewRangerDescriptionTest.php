<?php

namespace Symm\ViewRangerClient\Tests;

use Symm\ViewRangerClient\ViewRangerDescription;

class ViewRangerDescriptionTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnADescriptionObject()
    {
        $description = new ViewRangerDescription();
        $this->assertInstanceOf('GuzzleHttp\Command\Guzzle\Description', $description);
    }

    public function testItShouldOverrideTheBaseUrl()
    {
        $description = new ViewRangerDescription('http://example.com/');

        $this->assertEquals('http://example.com/', $description->getBaseUrl());
    }
}