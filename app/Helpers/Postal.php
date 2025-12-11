<?php
namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;

class Postal {

    protected $client;
    protected $headers;
    function __construct()
    {
        $this->client = new Client();
        $this->headers = [
            'x-api-auth' => 'apikey 62B19DD3BFF7348A09267EE7:FA111A70E7ED1A00F18F8EF3793A26930FDAA6AE5FC2D7B726543E08C7DCEED6',
            'Content-Type' => 'application/json',
        ];

    }


    public function createSheet(){
        $body = '{
          "sheet": {
            "parcel_category": "b",
            "sender": {
              "name": "Patrik Karaba",
              "organization": "WebPlace s.r.o",
              "street": "Trnovo 74",
              "city": "Martin",
              "zip": "03601",
              "country": "SK",
              "phone": "+421918883992",
              "email": "info@web-place.sk"
            },
            "reception_method": "post",
            "payment_type": "h"
          }
        }';
        $request = new Request('PUT', 'https://mojezasielky.posta.sk/integration/rest/v1/sheets', $this->headers, $body);
        $res = $this->client->send($request);
        $responseBody = $res->getBody()->getContents();
        return json_decode($responseBody);
    }
    public function createParcel($sheet,$customer, $email, $invoiceNumber)
    {

        $bodyArray = [
            "parcel" => [
                "recipient" => [
                    "name" => $customer->delivery_name,
                    "street" => $customer->delivery_address,
                    "city" => $customer->delivery_city,
                    "zip" => $customer->delivery_postal,
                    "country" => "sk",
                    "phone" => $customer->delivery_phone ?? "",
                    "email" => $email,
                ],
                "services" => [
                    "f",
                    "iod"
                ],

                "cod" => [
                    "type" => "bdnu",
                    "amount" => [
                        "value" => 10.00,
                        "currency" => "eur"
                    ],
                    "iban" => " SK3511000000002943075904",
                    "symbol" => "{$invoiceNumber}"
                ],
                "custom_identifier" => "{$invoiceNumber}",
                "note" => "WebPlace s.r.o - produkt",
            ]
        ];
        $body = json_encode($bodyArray);

        $request = new Request('PUT', 'https://mojezasielky.posta.sk/integration/rest/v1/sheets/'.$sheet.'/parcels', $this->headers, $body);
        $res = $this->client->send($request);
        $responseBody = $res->getBody()->getContents();
        return json_decode($responseBody);
    }

    public function createLabel($sheetId, $parcelId)
    {
        $bodyArray = ['format' => 'pdf'];
        $body = json_encode($bodyArray);
        $request = new Request('POST', 'https://mojezasielky.posta.sk/integration/rest/v1/sheets/'.$sheetId.'/parcels/'.$parcelId.'/labels', $this->headers, $body);
        $res = $this->client->send($request);
        $responseBody = $res->getBody()->getContents();
        return json_decode($responseBody);
    }
}
