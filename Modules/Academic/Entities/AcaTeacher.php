<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_code', 'person_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaTeacherFactory::new();
    }
}
