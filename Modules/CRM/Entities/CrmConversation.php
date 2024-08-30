<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CRM\Database\factories\CrmConversationFactory;

class CrmConversation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'user_id',
        'type_name',
        'description',
        'type_action',
        'status'
    ];

    protected static function newFactory(): CrmConversationFactory
    {
        //return CrmConversationFactory::new();
    }

    public function messages()
    {
        return $this->hasMany(CrmMessage::class, 'conversation_id');
    }

    public function participants()
    {
        return $this->hasMany(CrmParticipant::class, 'conversation_id');
    }

    public function user()
    {
        return $this->belongsTo(CrmUser::class, 'user_id');
    }
}
