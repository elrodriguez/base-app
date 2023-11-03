<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcaCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'course_day',
        'course_month',
        'course_year',
        'category_id',
        'image',
        'modality_id',
        'type_description',
        'teacher_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaCourseFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AcaCategoryCourse::class, 'category_id');
    }
    public function modality(): BelongsTo
    {
        return $this->belongsTo(AcaModality::class, 'modality_id', '');
    }
}
