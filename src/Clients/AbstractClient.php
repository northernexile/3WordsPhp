<?php

namespace Northernexile\ThreeWords\Clients;

use GuzzleHttp\Client;
use Northernexile\ThreeWords\Constants\ConstantInterface;

/**
 * Class AbstractClient
 */
abstract class AbstractClient
{
    /** @var Client */
    protected $client;

    /**
     * @var array
     */
    protected $methods = [
        ConstantInterface::GET,
        ConstantInterface::POST
    ];

    /** @var string  */
    protected $method = ConstantInterface::GET;

    /** @var string|null  */
    protected $route = null;

    /** @var array  */
    protected $parameters = [];

    /** @var mixed */
    protected $response;

    /** @var null|string  */
    protected $apiVersion = null;

    /** @var null|string  */
    protected $url = null;

    /** @var null|string */
    protected $apiKey = null;

    /**
     * AbstractClient constructor.
     * @param Client $client
     */
    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    /**
     * @throws \Exception
     */
    public function request() :self
    {
        $this->loadConfig();

        if(is_null($this->method)){
            throw new \Exception(self::class.' request method not set');
        }

        switch ($this->method){
            case ConstantInterface::GET:
                $this->get();
                break;
            case ConstantInterface::POST:
                $this->post();
                break;
        }

        return $this;
    }

    private function get()
    {
        $url = $this->getUrl().'?';
        $this->addParameter('key',$this->apiKey);
        $url.=http_build_query($this->parameters);

        $this->response = $this->client->get(
            $url
        );
    }

    private function post()
    {

    }

    /**
     * @throws \Exception
     */
    public function getResponse() :array
    {
        if(is_null($this->response) || empty($this->response)){
            throw new \Exception('No API Response');
        }

        if($this->response->getStatusCode() == 200){
            return \json_decode($this->response->getBody());
        }
    }

    /**
     * @param array $parameters
     */
    public function addParameters(array $parameters=[]) :void
    {
        foreach ($parameters as $key=>$value){
            $this->addParameter($key,$value);
        }
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addParameter(string $key,string $value) :void
    {
        array_push($this->parameters,[$key=>$value]);
    }

    /**
     * @return string
     */
    private function getUrl() :string
    {
        return
            $this->url.
            '/'.
            $this->apiVersion.
            '/'.
            $this->route;
    }


    /**
     * @throws \Exception
     */
    private function loadConfig() :void
    {
        $this->url = config('threewords.url');

        if(is_null($this->url)){
            throw new \Exception('what three words url is missing');
        }

        $this->apiVersion = config('threewords.version');

        if(is_null($this->apiVersion)){
            throw new \Exception('Version is missing');
        }

        $this->apiKey = config('threewords.key');

        if(is_null($this->apiKey)){
            throw new \Exception('What 3 words API key is missing');
        }

        if(is_null($this->route)){
            throw new \Exception('What 3 words API function not specified');
        }
    }
}