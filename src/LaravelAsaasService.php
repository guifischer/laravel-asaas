<?php

namespace guivic\LaravelAsaas;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Softr\Asaas\Asaas;
use Softr\Asaas\Adapter\GuzzleHttpAdapter;

class LaravelAsaasService
{

    protected  $httpClient;

    protected  $url;

    public function __construct(Client $client)
    {
        // $adapter = new GuzzleHttpAdapter(config("asaas.api_key"));
        // $this->asaas = new Asaas($adapter, config('asaas.enviroment'));
        $this->httpClient = $client;
        $this->url = $this->getURL();
    }

    protected function getURL()
    {
        if (config("asaas.enviroment") === 'production') {
            return "https://asaas.com/api/v3";
        }

        return "https://sandbox.asaas.com/api/v3";
    }

    protected function getHeaders()
    {
        return [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'access_token' => config("asaas.api_key")
        ];
    }

    protected function get($path) {
        $response = $this->httpClient->request('GET', $this->url . $path, [
            "headers" => $this->getHeaders()
        ]);
        return $response->getBody()->getContents();
    }

    protected function post($path, $data) {
        $response = $this->httpClient->request('POST', $this->url . $path, [
            "headers" => $this->getHeaders(),
            "body" => $data
        ]);
        return $response->getBody()->getContents();
    }

    public function addClient(array $clientData)
    {

        $response = $this->post('/customers', json_encode($clientData));
        dd($response);
    }

    public function listSpecificClient(string $id)
    {
        $response = $this->get('/customers/'.$id);
        dd($response);
    }

    public function addSubscription(array $subscriptionData)
    {
        $response = $this->post('/subscriptions', json_encode($subscriptionData));
        dd($response);
    }

    public function addSpecificSubscription(string $id)
    {
        $response = $this->get('/subscriptions/'.$id);
        dd($response);
    }

    static function webhook(Request $request) {
        return [];
    }
}