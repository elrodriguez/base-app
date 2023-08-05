<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'icon',
        'route',
        'main',
        'status',
        'user_id'
    ];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\CmsPageFactory::new();
    }
}
