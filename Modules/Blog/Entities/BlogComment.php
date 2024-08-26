<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
