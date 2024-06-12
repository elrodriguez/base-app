<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MetaController extends Controller
{
    public function sendMessageWhatsapp(Request $request)
    {
        $url = "https://graph.facebook.com/v19.0/347133948480424/messages";
        $token = "EAAUfk2ptXbIBO3TRQ46CyIWhn2O2QCoKUgMqT7AZAvHKyHx7Rt3SWu7oSQHG1Moz2lE8TnQFEzgdZCAQM30tPoR3oOucKiJPzHkJ1KSpYS9pFKS8BC7JtI2wZAy4XmeFuOfxqvd3ZCPAHMoUzSyM32D9Hx1mgfCNevQcCh0zkN7x9E5GvIY6pvMg3YS5V5wcL55ZCjU56pKeHHSJr90sZD";

        // Obtener los parámetros de la solicitud
        // $number = $request->input('number');
        $number = '+51921008708';
        $message = $request->input('message');

        // Asegúrate de que las variables estén definidas correctamente
        if (!$number || !$message) {
            return response()->json([
                'error' => 'Número y mensaje son requeridos.'
            ], 400);
        }

        // Estructura de datos para la solicitud
        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $number,
            "type" => "template",
            "template" => [
                "name" => "citas_odontologo",
                "language" => [
                    "code" => "es"
                ],
            ]
        ];


        // Crear un cliente HTTP
        $client = new Client();
        try {

            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ];

            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'form_params' => $data
            ]);

            // Obtener el código de estado y el cuerpo de la respuesta
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            // Devolver la respuesta en formato JSON
            return response()->json([
                'status' => $statusCode,
                'response' => json_decode($body, true)
            ]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
