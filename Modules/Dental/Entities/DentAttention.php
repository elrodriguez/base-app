<?php

namespace Modules\Dental\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dental\Database\factories\DentAttentionFactory;

class DentAttention extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'date_time_attention',
        'current_illness',
        'reason_consultation',
        'age',
        'sick_time',
        'appetite',
        'thirst',
        'dream',
        'mood',
        'urine',
        'depositions',
        'weight_loss',
        'pex_tem',
        'pex_pa',
        'pex_fc',
        'pex_fr',
        'pex_peso',
        'pex_talla',
        'pex_imc',
        'treatment',
        'pex_aux_examination',
        'doctor_id',
        'user_id',
        'patient_id',
        'appointment_id',
        'next_appointment_id',
        'signed_accepted',
        'observations',
        'history_id'
    ];

    protected static function newFactory(): DentAttentionFactory
    {
        //return DentAttentionFactory::new();
    }
}
