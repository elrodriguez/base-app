<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academic\Database\factories\AcaTeachingResumeFactory;

class AcaTeachingResume extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'teacher_id',
        'type',
        'description',
        'charge',
        'company',
        'start_date',
        'end_date'
    ];

    protected static function newFactory(): AcaTeachingResumeFactory
    {
        //return AcaTeachingResumeFactory::new();
    }
}
