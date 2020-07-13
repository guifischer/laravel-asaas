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
        return json_decode($response->getBody()->getContents());
    }

    protected function post($path, $data) {
        $response = $this->httpClient->request('POST', $this->url . $path, [
            "headers" => $this->getHeaders(),
            "body" => $data
        ]);
        return json_decode($response->getBody()->getContents());
    }

    protected function delete($path) {
        $response = $this->httpClient->request('DELETE', $this->url . $path, [
            "headers" => $this->getHeaders()
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function addClient(array $clientData)
    {

        $response = $this->post('/customers', json_encode($clientData));
        return $response;
    }

    public function listSpecificClient(string $id)
    {
        $response = $this->get('/customers/'.$id);
        return $response;
    }

    public function getInstallments(string $id)
    {
        $response = $this->get('/payments?installment='.$id);
        return $response;
    }

    public function addSubscription(array $subscriptionData)
    {
        $response = $this->post('/subscriptions', json_encode($subscriptionData));
        return $response;
    }

    public function editSubscription(string $id, array $subscriptionData)
    {
        $response = $this->post('/subscriptions/'.$id, json_encode($subscriptionData));
        return $response;
    }

    public function cancelSubscription(string $id)
    {
        $response = $this->delete('/subscriptions/'.$id);
        return $response;
    }

    public function addPayment(array $subscriptionData)
    {
        $response = $this->post('/payments', json_encode($subscriptionData));
        return $response;
    }
    
    public function getPayment(string $id)
    {
        $response = $this->get('/payments/'.$id);
        return $response;
    }

    public function addSpecificSubscription(string $id)
    {
        $response = $this->get('/subscriptions/'.$id);
        return $response;
    }

    static function webhook(Request $request) {
        return [];
    }

}
