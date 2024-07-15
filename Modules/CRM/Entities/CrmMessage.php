<?php

namespace Modules\CRM\Entities;

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
        'type'
    ];

    public function conversation()
    {
        return $this->belongsTo(CrmConversation::class);
    }

    public function user()
    {
        return $this->belongsTo(CrmUser::class);
    }
}
