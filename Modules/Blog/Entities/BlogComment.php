<?php

namespace Modules\Blog\Entities;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Blog\Database\factories\BlogCommentFactory;

class BlogComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'message',
        'user_id',
        'person_id',
        'article_id',
        'appreciate',
        'comment_id'
    ];

    protected static function newFactory(): BlogCommentFactory
    {
        //return BlogCommentFactory::new();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function getMessageAttribute($value)
    {
        return html_entity_decode($value, ENT_QUOTES, "UTF-8");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'comment_id');
    }
}
