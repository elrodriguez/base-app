<?php

namespace Modules\CRM\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\CRM\Entities\CrmConversation;
use Modules\CRM\Entities\CrmMessage;
use Modules\CRM\Entities\CrmParticipant;
use Modules\CRM\Entities\CrmUser;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CrmMessagesController extends Controller
{
    use ValidatesRequests;

    public function sendMessage(Request $request)
    {
        $this->validate(
            $request,
            [
                'fromUserId' => 'required',
                'text' => 'required|string',
            ]
        );

        $personId = Auth::user()->person_id;
        $contactId = $request->get('fromUserId');

        // Buscar conversación existente
        $conversationId = CrmParticipant::whereIn('person_id', [$contactId, $personId])
            ->groupBy('conversation_id')
            ->having(DB::raw('COUNT(DISTINCT user_id)'), '>=', 2)
            ->value('conversation_id');

        if (!$conversationId) {
            // Crear nueva conversación
            $conversation = CrmConversation::create([
                'title' => 'private',
                'user_id' => Auth::id(),
                'type_name' => 'whatsapp',
            ]);

            // Agregar participantes
            CrmParticipant::create([
                'conversation_id' => $conversation->id,
                'person_id' => $personId,
                'user_id' => Auth::id()
            ]);
            CrmParticipant::create([
                'conversation_id' => $conversation->id,
                'person_id' => $contactId,
                'user_id' => CrmUser::where('person_id', $contactId)->value('id') ?? null
            ]);

            $conversationId = $conversation->id;
        }

        // Crear el mensaje
        CrmMessage::create([
            'conversation_id' => $conversationId,
            'person_id' => $personId,
            'content' => $request->get('text'),
            'type' => $request->get('type')
        ]);

        // Devolver la conversación con los mensajes
        return response()->json(['success' => true], 201);
    }

    public function getMessages(Request $request)
    {
        $conversationId = $request->get('conversationId');
        $personId = $request->get('personId');

        $AuthpersonId = Auth::user()->person_id;

        $messages = CrmMessage::where('conversation_id', $conversationId)
            ->orderBy('created_at')
            ->get();

        $formattedMessages = $messages->map(function ($message) use ($AuthpersonId, $personId) {
            $message->fromUserId = ($message->person_id == $AuthpersonId ? $personId : 0);
            $message->toUserId = ($message->person_id == $AuthpersonId ? 0 : $personId);
            $message->text = $message->content;
            $message->time = timeElapsed($message->created_at);
            return $message;
        });
        //dd($formattedMessages);
        return response()->json($formattedMessages);
    }

    public function uploadMessagesAudio(Request $request)
    {
        $audioData = $request->input('audio');

        // Eliminar el prefijo "data:audio/mpeg;base64,"
        $base64Data = substr($audioData, strpos($audioData, ',') + 1);

        // Decodificar los datos base64 a bytes binarios
        $audioBytes = base64_decode($base64Data);

        // Generar un nombre de archivo único
        $fileName = uniqid() . '.mp3';
        $filePath = 'audios/' . $fileName;

        // Guardar el archivo en el disco de almacenamiento público de Laravel
        Storage::disk('public')->put($filePath, $audioBytes);

        // Obtener la ruta pública del archivo
        $path = Storage::disk('public')->url($filePath);

        // Devolver la ruta del archivo almacenado
        return response()->json([
            'path' => $path,
            'file_name' => $filePath
        ], 200);
    }


    public function deleteFile(Request $request)
    {
        $filename = public_path('storage/' . $request->get('filename'));
        // Verifica si el archivo existe
        //dd($filename);
        if (file_exists($filename)) {
            // Elimina el archivo
            unlink($filename);

            // Devuelve una respuesta exitosa
            return response()->json(['message' => 'Archivo eliminado correctamente.'], 200);
        } else {
            // Devuelve una respuesta de error si el archivo no existe
            return response()->json(['message' => 'El archivo no existe.'], 404);
        }
    }

    public function uploadMessagesFile(Request $request)
    {
        $this->validate(
            $request,
            [
                'file' => 'required',
            ]
        );

        $success = true;
        $errorPdf = null;
        $path = null;

        $pdfFile = $request->file('file');
        if ($pdfFile && $pdfFile->extension() == 'pdf') {
            $fileSizeInMB = $pdfFile->getSize() / (1024 * 1024);
            $destination = 'chat/pdf';
            $filename = time() . '.' . $pdfFile->extension();
            $path = Storage::disk('public')->putFileAs($destination, $pdfFile, $filename);
        } else {
            $errorPdf = 'Solo se permiten archivos PDF.';
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'filePath' => $path,
            'errorPdf' => $errorPdf,
            'size' => round($fileSizeInMB, 2)
        ]);
    }

    public function downloadMessageFile($message_id)
    {

        // Buscar la ruta del archivo en la base de datos
        $file = CrmMessage::findOrFail($message_id);
        $filePath = explode('@', $file->content);

        // Descargar el archivo
        return Storage::download($filePath[1]);
    }
}
