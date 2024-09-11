<?php

namespace Modules\CRM\Http\Controllers;

use App\Models\Person;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\CRM\Entities\CrmConversation;
use Modules\CRM\Entities\CrmMessage;
use Modules\CRM\Entities\CrmParticipant;

class CrmChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('CRM::Chat/Dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getContacts()
    {
        $persomId = Auth::user()->person_id;
        $persons = Person::join('users', 'people.id', 'users.person_id')
            ->where('id', '<>', $persomId)
            ->latest();

        if (request()->has('search')) {
            $persons->where('full_name', 'like', '%' . request()->input('search') . '%');
        }
        $persons = $persons->paginate(5);

        // Modificar cada registro antes de devolverlo
        $formattedPersons = $persons->getCollection()->map(function ($person) use ($persomId) {
            // // Formatear las fechas
            // $person->created_at_formatted = $person->created_at->format('Y-m-d H:i:s');
            // $person->updated_at_formatted = $person->updated_at->format('Y-m-d H:i:s');

            // Agregar el campo estado basado en alguna condición
            $conversationId = CrmParticipant::whereIn('person_id', [$persomId, $person->id])
                ->groupBy('conversation_id')
                ->having(DB::raw('COUNT(DISTINCT user_id)'), '>=', 2)
                ->value('conversation_id');

            $person->conversationId = $conversationId;
            $person->userId = $person->id;
            $person->time = '2:09 PM';
            $person->preview = 'Wasup for the third time like is you bling bitch';
            $person->messages = [];
            $person->active = true;
            return $person;
        });

        // Reemplazar la colección de personas en la paginación con la colección formateada
        $persons->setCollection($formattedPersons);

        return response()->json($persons);
    }
}
