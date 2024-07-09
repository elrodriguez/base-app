<?php

namespace Modules\CRM\Http\Controllers;

use App\Models\Person;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
        $persons = Person::where('id', '<>', Auth::user()->person_id)->latest();
        if (request()->has('search')) {
            $persons->where('full_name', 'like', '%' . request()->input('search') . '%');
        }
        $persons = $persons->paginate(5);

        // Modificar cada registro antes de devolverlo
        $formattedPersons = $persons->getCollection()->map(function ($person) {
            // // Formatear las fechas
            // $person->created_at_formatted = $person->created_at->format('Y-m-d H:i:s');
            // $person->updated_at_formatted = $person->updated_at->format('Y-m-d H:i:s');

            // Agregar el campo estado basado en alguna condición
            // Por ejemplo, si hay un campo 'is_active' en la tabla de personas
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
