<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MetaController extends Controller
{
    public function sendMessageWhatsapp(Request $request)
    {
        $url = "https://graph.facebook.com/v19.0/347133948480424/messages";
        $token = "EAAUfk2ptXbIBO40bbaDXEYMIBmvxeoguwZBBv7iBms6F2eEbeCvSNltzzSPdicLTuoKZCqNchbNTPuU5alHLyDCyxuyLZA6iJAxuQFYfVysfZA14Tn3nOjuayXTkWrpW5cHbk0j9qYSqZCSJLqIJ0ZBgsrBW1JlLeLhy2T8LurSCoNReSd8OZA2ZAjGuvRvTyfT1HOioL6dXvFXUj1LXvawZD";

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
                "name" => "prueba_dos",
                "language" => [
                    "code" => "es-ARG"
                ],
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
