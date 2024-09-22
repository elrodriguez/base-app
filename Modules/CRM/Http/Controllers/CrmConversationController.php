<?php

namespace Modules\CRM\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\CRM\Entities\CrmConversation;
use Modules\CRM\Entities\CrmMessage;
use Modules\CRM\Entities\CrmParticipant;
use Modules\CRM\Events\SendNotification;

class CrmConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getConversations()
    {
        $persomId = Auth::user()->person_id;

        $conversations = CrmParticipant::join('crm_conversations', 'conversation_id', 'crm_conversations.id')
            ->join('people', 'crm_participants.person_id', 'people.id')
            ->select(
                'crm_conversations.new_message',
                'crm_conversations.id',
            )
            ->where('person_id', $persomId)
            ->limit(5)
            ->get();

        $total_new = 0;
        foreach ($conversations as $row) {
            if ($row->new_message) {
                $total_new += 1;
            }
        }

        $formattedConversations = $conversations->map(function ($conversation) use ($persomId) {
            $message_last = CrmMessage::with('person')
                ->where('conversation_id', $conversation->id)
                ->where('person_id', '<>', $persomId)
                ->orderByDesc('id')
                ->first();

            $preview = '';
            if ($message_last) {
                $who = $message_last->person_id == $persomId ? '<strong class="text-sm mr-1">Tu: </strong>' : '<strong class="text-sm mr-1">' . $message_last->person->full_name . ': </strong>';

                if ($message_last->type == 'text') {
                    $strcontent = strlen($message_last->content) > 30 ? substr($message_last->content, 0, 30) . ' ...' : $message_last->content;
                    $preview = ($who . $strcontent);
                } else if ($message_last->type == 'audio') {
                    $preview = ($who . 'audio');
                } else if ($message_last->type == 'link') {
                    $preview = ($who . 'enlace');
                } else {
                    $preview = ($who . 'archivo');
                }
            }
            $conversation->time = $message_last ? timeElapsed($message_last->created_at) : null;
            $conversation->image = $message_last ? $message_last->person->image : null;
            $conversation->full_name = $message_last ? $message_last->person->full_name : null;
            $conversation->person_id = $message_last ? $message_last->person->id : null;
            $conversation->email = $message_last ? $message_last->person->email : null;
            $conversation->preview = $message_last ? $preview : null;
            $conversation->new_order = $message_last ? $message_last->created_at : null;

            return $conversation;
        });

        $formattedConversations = $formattedConversations->sortByDesc('new_order')->values();

        return response()->json([
            'conversations' => $formattedConversations,
            'totalNew' => $total_new
        ]);
    }


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
