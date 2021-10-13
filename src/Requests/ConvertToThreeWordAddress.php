<?php


namespace Northernexile\ThreeWords\Requests;


use Northernexile\ThreeWords\Clients\AbstractClient;
use Northernexile\ThreeWords\Constants\ConstantInterface;
use Northernexile\ThreeWords\Interfaces\MakeRequestInterface;
use Northernexile\ThreeWords\Interfaces\ResponseInterface;

/**
 * Class ConvertToThreeWordAddress
 * @package Northernexile\ThreeWords\Requests
 */
final class ConvertToThreeWordAddress
    extends AbstractClient
    implements MakeRequestInterface, ResponseInterface
{
    protected $route = ConstantInterface::CONVERT_TO_3_WORDS;

    /** @var string */
    protected $latitude;

    /** @var string */
    protected $longitude;

    /**
     * @param string $latitude
     */
    public function setLatitude(string $latitude): ConvertToThreeWordAddress
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude(string $longitude): ConvertToThreeWordAddress
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return AbstractClient
     * @throws \Exception
     */
    public function request(): AbstractClient
    {
        $this->addParameter('coordinates',$this->latitude.','.$this->longitude);

        return parent::request();
    }
}
