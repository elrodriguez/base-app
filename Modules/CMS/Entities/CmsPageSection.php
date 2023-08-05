<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsPageSection extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\CmsPageSectionFactory::new();
    }
}
