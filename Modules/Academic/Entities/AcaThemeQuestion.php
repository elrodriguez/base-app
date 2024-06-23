<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academic\Database\factories\AcaThemeQuestionFactory;

class AcaThemeQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'module_id',
        'theme_id',
        'description',
        'comment_id',
        'i_like',
        'not_like'
    ];

    protected static function newFactory(): AcaThemeQuestionFactory
    {
        //return AcaThemeQuestionFactory::new();
    }
}
