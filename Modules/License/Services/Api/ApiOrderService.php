<?php

namespace Modules\License\Services\Api;

class ApiOrderService
{
    private const API_BASE_URL = 'https://pay.web-place.sk/api/';
    private const AUTH_HEADER = 'Authorization: Bearer ';

    public function create(array $data)
    {
        return $this->call('POST', 'order/create', $data);
    }

    public function get(string $id)
    {
        return $this->call('GET', 'order/get/' . $id);
    }

    public function payStatus(string $id)
    {
        return $this->call('GET', 'order/payed/' . $id);
    }

    private function call(string $method, string $endpoint, ?array $data = null)
    {
        $headers = [self::AUTH_HEADER . config('system.payment_token')];

        return $this->makeRequest(
            $method,
            self::API_BASE_URL . $endpoint,
            $data,
            $headers
        );
    }

    private function makeRequest(string $method, string $url, ?array $data = null, ?array $headers = null)
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        if ($method === 'POST' && $data) {
            $options[CURLOPT_POSTFIELDS] = $data;
        }

        if ($headers) {
            $options[CURLOPT_HTTPHEADER] = $headers;
        }

        $curl = curl_init();
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
