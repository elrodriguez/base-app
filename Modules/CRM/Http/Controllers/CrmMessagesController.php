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

        return response()->json($formattedMessages);
    }

    public function uploadMessagesAudio(Request $request)
    {
        // dd($request->all());
        // Validar la solicitud
        // $this->validate(
        //     $request,
        //     [
        //         'audio' => 'required|file|mimes:wav,mp3,ogg,blog|max:10240', // 10MB máximo
        //     ]
        // );

        // Obtener el archivo subido
        $file = $request->file('audio');

        // Generar un nombre único para el archivo
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Almacenar el archivo en el disco 'public'
        $path = $file->storeAs('audios', $fileName, 'public');

        // Devolver la ruta del archivo almacenado
        return response()->json(['path' => $path], 200);
    }
}
