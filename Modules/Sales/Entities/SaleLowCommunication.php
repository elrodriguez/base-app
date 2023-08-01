<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleLowCommunication extends Model
{
    use HasFactory;

    protected $fillable = [
        'communication_name',
        'generation_date',
        'communication_date',
        'correlative',
        'sunat_points',
        'ticket',
        'cdr',
        'xml',
        'pdf',
        'response_code',
        'response_description',
        'notes',
        'status',
        'user_id',
        'anio'
    ];

    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SaleLowCommunicationFactory::new();
    }
}
