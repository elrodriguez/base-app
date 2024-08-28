<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'icon', 'color', 'status'];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogCategoryFactory::new();
    }

    public function articles(): HasMany
    {
        return $this->hasMany(BlogArticle::class, 'category_id');
    }
}
