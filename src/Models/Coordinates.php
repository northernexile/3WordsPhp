<?php


namespace Northernexile\ThreeWords\Models;

/**
 * Class Coordinates
 * @package Northernexile\ThreeWords\Models
 */
class Coordinates
{
    /** @var string */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Coordinates
     */
    public function setLatitude(string $latitude): Coordinates
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Coordinates
     */
    public function setLongitude(string $longitude): Coordinates
    {
        $this->longitude = $longitude;
        return $this;
    }


}