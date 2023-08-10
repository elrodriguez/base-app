<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CmsSectionItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'section_id', 'position', 'description'];

    protected static function newFactory()
    {
        return \Modules\CMS\Database\factories\CmsSectionItemFactory::new();
    }
}
