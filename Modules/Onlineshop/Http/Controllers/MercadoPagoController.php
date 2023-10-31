<?php

namespace Modules\Onlineshop\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));


class MercadoPagoController extends Controller
{
    private $client;

    function __construct()
    {
        $this->client = new PaymentClient();
    }

    public function paymentRequest()
    {
        try {

            // Step 4: Create the request array
            $request = [
                "transaction_amount" => 100,
                "token" => env('MERCADOPAGO_TOKEN'),
                "description" => "prueba",
                "installments" => 1,
                "payment_method_id" => "visa",
                "payer" => [
                    "email" => "user@test.com",
                ]
            ];

            // Step 5: Make the request
            $payment = $this->client->create($request);
            echo $payment->id;

            // Step 6: Handle exceptions
        } catch (MPApiException $e) {
            dd("Status code: " . $e->getApiResponse()->getStatusCode() . "\n");
            dd("Content: " . $e->getApiResponse()->getContent() . "\n");
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
