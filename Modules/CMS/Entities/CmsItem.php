<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'item_id',
        'position',
        'content'
    ];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\CmsItemFactory::new();
    }
}
