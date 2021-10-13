<?php


namespace Northernexile\ThreeWords;


use Illuminate\Support\ServiceProvider;
use Northernexile\ThreeWords\Requests\ConvertToThreeWordAddress;

/**
 * Class ThreeWordsServiceProvider
 * @package Northernexile\ThreeWords
 */
class ThreeWordsServiceProvider extends ServiceProvider
{
    /** @var string[]  */
    public $bindings = [
        ThreeWords::class
    ];

    public function register()
    {
        app()->bind('ThreeWords',function (){
            return new ThreeWords(
                new ConvertToThreeWordAddress(
                    new \GuzzleHttp\Client()
                )
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/threewords.php' => \config_path('threewords.php'),
        ]);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'Northernexile\ThreeWords\ThreeWordsServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Acme' => 'Northernexile\ThreeWords\Facade',
        ];
    }
}