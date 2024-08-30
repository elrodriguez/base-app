<?php

namespace Modules\CRM\Entities;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CRM\Database\factories\CrmMessagesFactory;

class CrmMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'conversation_id',
        'person_id',
        'content',
        'server_response',
        'type',
        'attachments',
        'email_from',
        'email_for',
        'status'
    ];

    public function conversation()
    {
        return $this->belongsTo(CrmConversation::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function getContentAttribute($value)
    {
        return html_entity_decode($value, ENT_QUOTES, "UTF-8");
    }
}
