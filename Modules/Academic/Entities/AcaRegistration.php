<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'status', 'modality_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaRegistrationFactory::new();
    }

    public function student()
    {
        return $this->belongsTo(AcaStudent::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(AcaCourse::class, 'course_id');
    }
}
