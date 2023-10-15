<?php

namespace Modules\Onlineshop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnliSaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'item_id',
        'entitie',
        'price',
        'quantity',
        'onli_item_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Onlineshop\Database\factories\OnliSaleDetailFactory::new();
    }
}
