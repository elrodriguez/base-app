<?php

namespace Modules\Onlineshop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnliSaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Onlineshop\Database\factories\OnliSaleDetailFactory::new();
    }
}
