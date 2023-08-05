<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'component_id'
    ];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\CmsSectionFactory::new();
    }
}
