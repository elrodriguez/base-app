<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content_text',
        'imagen',
        'views',
        'likes',
        'url',
        'publicity',
        'status'
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogArticleFactory::new();
    }

    public function getContentTextAttribute($value)
    {
        return html_entity_decode($value, ENT_QUOTES, "UTF-8");
    }
    public function getImagenAttribute($value)
    {
        return ($value != 'img/imagen-no-disponible.jpg' ? asset('storage/' . $value) : asset($value));
    }
}
