<?php


namespace Northernexile\ThreeWords;

use Northernexile\ThreeWords\Models\Coordinates;
use Northernexile\ThreeWords\Requests\ConvertToThreeWordAddress;

/**
 * Class ThreeWords
 * @package Northernexile\ThreeWords
 */
class ThreeWords
{
    /** @var ConvertToThreeWordAddress|null */
    private $convertToThreeWordAddress = null;

    /**
     * ThreeWords constructor.
     * @param ConvertToThreeWordAddress $convertToThreeWordAddress
     */
    public function __construct(
        ConvertToThreeWordAddress $convertToThreeWordAddress
    )
    {
        $this->convertToThreeWordAddress = $convertToThreeWordAddress;
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
}