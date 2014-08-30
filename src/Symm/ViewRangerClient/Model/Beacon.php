<?php

namespace Symm\ViewRangerClient\Model;

/**
 * Beacon
 */
final class Beacon
{
    /**
     * The location
     *
     * @var Point
     */
    private $location;

    /**
     * The date and time
     *
     * @var \DateTime
     */
    private $dateTime;

    /**
     * The altitude in meters
     *
     * @var float
     */
    private $altitude;

    /**
     * The speed in km/h
     *
     * @var float
     */
    private $speed;

    /**
     * The heading in degrees
     *
     * @var float
     */
    private $heading;

    /**
     * Constructor
     *
     * @param Point     $location
     * @param \DateTime $dateTime
     * @param float     $altitude
     * @param float     $speed
     * @param float     $heading
     */
    public function __construct(Point $location, \DateTime $dateTime, $altitude, $speed, $heading)
    {
        $this->location  = $location;
        $this->dateTime  = $dateTime;
        $this->altitude  = $altitude;
        $this->speed     = $speed;
        $this->heading   = $heading;
    }

    /**
     * @param array $array
     *
     * @return Beacon
     * @throws \Exception
     */
    public static function fromArray($array)
    {
        return new Beacon(
            new Point(
                (float) $array['LATITUDE'],
                (float) $array['LONGITUDE']
            ),
            new \DateTime($array['DATE'], new \DateTimeZone('UTC')),
            (float) $array['ALTITUDE'],
            (float) $array['SPEED'],
            (float) $array['HEADING']
        );
    }

    /**
     * @return float
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return float
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * @return Point
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }
}