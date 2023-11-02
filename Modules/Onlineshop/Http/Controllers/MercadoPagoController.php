<?php

namespace Modules\Onlineshop\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

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
            $client = new PreferenceClient();
            $preference = $client->create([
                "external_reference" => "teste",
                "items" => array(
                    array(
                        "id" => "4567",
                        "title" => "Dummy Title",
                        "description" => "Dummy description",
                        "picture_url" => "http://www.myapp.com/myimage.jpg",
                        "category_id" => "eletronico",
                        "quantity" => 1,
                        "currency_id" => "BRL",
                        "unit_price" => 100
                    )
                ),
                "payment_methods" => [
                    "default_payment_method_id" => "master",
                    "excluded_payment_types" => array(
                        array(
                            "id" => "ticket"
                        )
                    ),
                    "installments"  => 12,
                    "default_installments" => 1
                ]
            ]);
            echo $preference->id;
            // Step 6: Handle exceptions
        } catch (MPApiException $e) {
            dd("Status code: " . $e->getApiResponse()->getStatusCode() . "\n");
            dd("Content: " . $e->getApiResponse()->getContent() . "\n");
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function responseMercadoPago(Request $request, $res)
    {
        dd($request->all());
    }
}
