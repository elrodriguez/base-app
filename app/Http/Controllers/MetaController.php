<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MetaController extends Controller
{
    public function sendMessageWhatsapp(Request $request)
    {
        $url = "https://graph.facebook.com/v20.0/347133948480424/messages";
        $token = "EAAUfk2ptXbIBOy7t7THZB6PCyamd9HZB6RO3iAt1gRTQFATXZA1UqdnfwZB3ZCxbbycJpSX7KTpRpvg3GTYBDa29mNoJdgSYP3orGFMZBaS4qEzBrTV6GB7izGSYZCG6pm11wvh4eJydAQXbYkzQlrZB8ij6VGqLgtXqqyuekejbsV5WjZAyHaxjdQCPgrfqF5sTuauT98C0mlkW5EbKzlvQZD";

        // Obtener los parámetros de la solicitud
        // $number = $request->input('number');
        $number = '51921008708';
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
            "type" => "text",
            "text" => [
                "preview_url" => true,
                "body" => $message
            ],
        ];


        // Crear un cliente HTTP
        $client = new Client();
        try {

            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => '*/*',
                'Content-Type' => 'application/json'
            ];

            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'body'    => json_encode($data)
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
