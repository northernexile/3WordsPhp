<?php


namespace Northernexile\ThreeWords;

/**
 * Class Facade
 * @package Northernexile\ThreeWords
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ThreeWords';
    }
}