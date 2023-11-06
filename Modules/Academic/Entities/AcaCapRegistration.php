<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaCapRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'status',
        'modality_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaCapRegistrationFactory::new();
    }
}
