<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class ApiInvoice
{
    protected $url = 'https://invoice.web-place.sk/api';

    public function login($email, $password)
    {
        $client = new Client();
        $response = $client->post(
            $this->url.'/login',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                ],
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }

    public function getAllCustomers($token)
    {
        $client = new Client();
        $response = $client->get(
            $this->url.'/user/customers',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ]
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }

    public function getAllInvoicess($token)
    {
        $client = new Client();
        $response = $client->get(
            $this->url.'invoice/all',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ]
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }
    public function getInvoices($token,$data)
    {
        $client = new Client();
        $response = $client->get(
            $this->url.'invoice/get/'.$data['number']/1,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ]
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }

    public function postCreateCustomer($token, $data)
    {
        $client = new Client();
        $response = $client->post(
            $this->url.'/user/store/supplier',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => $data,
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }

    public function postCreateInvoice($token, $data)
    {
        $client = new Client();
        $response = $client->post(
            $this->url.'/invoice/store',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => $data,
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }

    public function postSendInvoice($token, $data, $invoice_id)
    {
        $client = new Client();
        $response = $client->post(
            $this->url.'/invoice/send/'.$invoice_id,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ],
                'json' => $data,
            ]
        );
        $body = $response->getBody();
        return json_decode((string) $body);
    }
}
