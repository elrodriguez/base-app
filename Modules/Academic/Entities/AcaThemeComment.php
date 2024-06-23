<?php

namespace Modules\Academic\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Database\factories\AcaThemeCommentFactory;

class AcaThemeComment extends Model
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
        'question_id',
        'helped_me',
    ];

    protected static function newFactory(): AcaThemeCommentFactory
    {
        //return AcaThemeCommentFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
