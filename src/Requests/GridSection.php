<?php


namespace Northernexile\ThreeWords\Requests;


use Northernexile\ThreeWords\Clients\AbstractClient;
use Northernexile\ThreeWords\Constants\ConstantInterface;
use Northernexile\ThreeWords\Interfaces\MakeRequestInterface;
use Northernexile\ThreeWords\Interfaces\ResponseInterface;
use Northernexile\ThreeWords\Models\Coordinates;

/**
 * Class BoundingBox
 * @package Northernexile\ThreeWords\Requests
 */
class GridSection extends AbstractClient
    implements MakeRequestInterface,ResponseInterface
{
    /** @var string  */
    protected $route = ConstantInterface::GRID_SECTION;

    /** @var Coordinates */
    private $start;

    /** @var Coordinates */
    private $stop;

    /**
     * @param Coordinates $start
     * @param Coordinates $stop
     * @return $this
     */
    public function setCoordinates(Coordinates $start,Coordinates $stop) :GridSection
    {
        $this->start = $start;
        $this->stop = $stop;

        return $this;
    }

    /**
     * @param Coordinates $start
     * @return $this
     */
    public function setStart(Coordinates $start) :GridSection
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @param Coordinates $stop
     * @return $this
     */
    public function setStop(Coordinates $stop) :GridSection
    {
        $this->stop = $stop;

        return $this;
    }

    /**
     * @return AbstractClient
     * @throws \Exception
     */
    public function request(): AbstractClient
    {
        $param = \implode(
            ',',[
                    $this->start->getLatitude(),
                    $this->start->getLongitude(),
                    $this->stop->getLatitude(),
                    $this->stop->getLongitude()
        ]);


        $this->addParameter('bounding-box',$param);

        return parent::request();
    }
}