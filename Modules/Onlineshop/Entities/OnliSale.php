<?php

namespace Modules\Onlineshop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnliSale extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Onlineshop\Database\factories\OnliSaleFactory::new();
    }
}
