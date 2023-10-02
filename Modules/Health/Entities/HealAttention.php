<?php

namespace Modules\Health\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealAttention extends Model
{
    use HasFactory;

    protected $fillable = [
        'history_id',
        'age',
        'age_type',
        'hour',
        'who_takes_care_of_child',
        'father_invoolvement',
        'affection_child',
        'information',
        'reason',
        'doctor_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Health\Database\factories\HealAttentionFactory::new();
    }
}
