<?php

namespace App\Services;

/**
 * Class TransportAPIService
 * @package App\Services
 */
use Ixudra\Curl\Facades\Curl;


enum METHOD: string 
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}

class TransportAPIService
{
    protected string $url;
    protected string $method = 'GET';
    protected string $typeOfAuth = 'No Auth';
    protected string $typeOfData = 'application/json';

    protected array $config = [];
    protected array $payload = [];
    protected array $credentials = [];

    protected $response;
    protected array $bugMessage = [];

    protected int $timeout = 60;

    # inisiasi API
    public function __construct(string $url, array $config = [])
    {
        $this->url($url);

        if(count($config) > 0){
            $this->config($config);
        }
    }

    public static function endPoint(string $url): static
    {
        $result = app(static::class, ['url' => $url]);

        return $result;
    }

    # Execute API with Ixudra
    public function exec()
    {
        $this->response = Curl::to($this->url)
                            ->withContentType($this->typeOfAuth)
                            ->withTimeout($this->timeout)
                            ->returnResponseObject();
                            
        # Return with Object with return data object : {"content":false,"status":0,"contentType":null,"error":"Connection timed out after 10005 milliseconds"}

        # Statement With Payload
        if(count($this->getPayload()) > 0){
            $this->response = $this->response->withData($this->payload);
        }

        # Statement with Authentication
        # 1. Basic Auth
        if($this->typeOfAuth == "Basic Auth"){
            if(count($this->credentials) > 0){
                $userBasic = $this->credentials;
                $this->response =  $this->response->withOption('USERPWD', "{$userBasic['username']}:{$userBasic['password']}");
            }
        }elseif($this->typeOfAuth == "Bearer Token"){
        # 2. Bearer Token
            $this->response =  $this->response->withHeader(json_encode($this->credentials));
        }
        
        switch ($this->getMethod()) {
            case METHOD::GET->value:

                $this->response = $this->response->get();

                return $this->response;

                break;
            case METHOD::POST->value:

                $this->response = $this->response->post();

                return $this->response;

                break;
            case METHOD::PUT->value:
                
                $this->response = $this->response->put();

                return $this->response;

                break;
            case METHOD::DELETE->value:
                
                $this->response = $this->response->delete();

                return $this->response;

                break;
            
            default:
                $this->bugMessage(['method message' => 'Method Not Allowed']);

                return json_encode($this->getBugMessage());

                break;
        }

    }

    public function url(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function payload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function credentials(array $credential)
    {
        $this->credentials = $credential;

        return $this;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }

    public function method(string $method)
    {
        $this->method = $method;

        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function typeOfAuth(string $typeOfAuth)
    {
        $this->typeOfAuth = $typeOfAuth;

        return $this;
    }

    public function getTypeOfAuth(): string
    {
        return $this->typeOfAuth;
    }

    public function typeOfData(string $typeOfData)
    {
        $this->typeOfData = $typeOfData;

        return $this;
    }

    public function getTypeOfData(): string
    {
        return $this->typeOfData;
    }

    public function config(array $config)
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function bugMessage(array | string $message)
    {
        array_push($this->bugMessage, $message);

        return $this;
    }

    public function getBugMessage(): array
    {
        return $this->bugMessage;
    }

    public function timeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }


}
