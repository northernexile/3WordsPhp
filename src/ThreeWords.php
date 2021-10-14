<?php


namespace Northernexile\ThreeWords;

use Northernexile\ThreeWords\Models\Coordinates;
use Northernexile\ThreeWords\Requests\ConvertToThreeWordAddress;
use Northernexile\ThreeWords\Requests\GridSection;

/**
 * Class ThreeWords
 * @package Northernexile\ThreeWords
 */
class ThreeWords
{
    /** @var ConvertToThreeWordAddress|null */
    private $convertToThreeWordAddress = null;

    /** @var GridSection|null */
    private $gridSection = null;

    /**
     * ThreeWords constructor.
     * @param ConvertToThreeWordAddress $convertToThreeWordAddress
     */
    public function __construct(
        ConvertToThreeWordAddress $convertToThreeWordAddress,
        GridSection $gridSection
    )
    {
        $this->convertToThreeWordAddress = $convertToThreeWordAddress;
        $this->gridSection = $gridSection;
    }

    /**
     * @param $coordinates
     * @return array
     * @throws \Exception
     */
    public function convertFromCoordinates(Coordinates $coordinates) :array
    {
        return $this->convertToThreeWordAddress
            ->setLatitude($coordinates->getLatitude())
            ->setLongitude($coordinates->getLongitude())
            ->request()
            ->getResponse();
    }

    /**
     * @param Coordinates $start
     * @param Coordinates $stop
     * @return array
     * @throws \Exception
     */
    public function gridSection(Coordinates $start,Coordinates $stop) :array
    {
        return $this->gridSection
            ->setCoordinates($start,$stop)
            ->request()
            ->getResponse();
    }
}