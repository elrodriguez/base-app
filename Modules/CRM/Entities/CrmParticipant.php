<?php

namespace Modules\CRM\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CRM\Database\factories\CrmParticipantFactory;

class CrmParticipant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'conversation_id',
        'user_id',
        'person_id'
    ];

    protected static function newFactory(): CrmParticipantFactory
    {
        //return CrmParticipantFactory::new();
    }

    public function conversation()
    {
        return $this->belongsTo(CrmConversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
