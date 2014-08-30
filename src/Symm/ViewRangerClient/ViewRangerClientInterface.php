<?php

namespace Symm\ViewRangerClient;
use Symm\ViewRangerClient\Model\Beacon;
use Symm\ViewRangerClient\Model\LocationCollection;

/**
 * ViewRangerClientInterface
 */
interface ViewRangerClientInterface
{
    /**
     * Get the Last location of the user
     *
     * @param string  $username
     * @param integer $pin
     *
     * @return Beacon
     */
    public function getLastBeaconPosition($username, $pin);

    /**
     * Get the locations of a user between a given date interval
     *
     * @param string         $username
     * @param integer        $pin
     * @param null|\DateTime $start
     * @param null|\DateTime $end
     * @param null|integer   $limit
     *
     * @return Beacon[]
     */
    public function getBeaconPositions($username, $pin, \DateTime $start = null, \DateTime $end = null, $limit = null);
}