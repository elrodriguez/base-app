<?php

namespace Modules\Health\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'f_nacimiento',
        'address'
    ];

    
    protected static function newFactory()
    {
        return \Modules\Health\Database\factories\HealPatientFactory::new();
    }
}
