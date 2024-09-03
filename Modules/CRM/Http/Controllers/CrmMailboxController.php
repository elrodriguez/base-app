<?php

namespace Modules\CRM\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Modules\CRM\Entities\CrmConversation;

class CrmMailboxController extends Controller
{
    private $P000011 = null;

    public function __construct()
    {
        $this->P000011 = Parameter::where('parameter_code', 'P000011')->value('value_default');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $person = Person::find($user->person_id);

        if ($user->hasRole('admin')) {
            $mailList = CrmConversation::with('user.person')
                ->with('messages.person')
                ->where('type_name', 'email')
                ->get();

            // Cambia el campo type_name a 'inbox' si el usuario es administrador
            $mailList->transform(function ($conversation) use ($user) {
                if ($conversation->user_id != $user->id) {
                    $conversation->type_action = 'inbox'; // Cambiar el valor
                }
                return $conversation;
            });
        } else {
            $mailList = CrmConversation::whereHas('participants', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->with('user.person')
                ->with('messages.person')
                ->where('type_name', 'email')
                ->get();
        }

        return Inertia::render('CRM::Mailbox/Dashboard', [
            'emailfor' => $this->P000011,
            'person' => $person,
            'mailList' => $mailList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('crm::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('crm::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
