<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Restaurant\Database\factories\ResSaleFactory;

class ResSale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sale_date',
        'sale_hour',
        'correlative',
        'user_id',
        'person_id',
        'local_id',
        'total',
        'total_discount',
        'payments',
        'petty_cash_id'
    ];

    protected static function newFactory(): ResSaleFactory
    {
        //return ResSaleFactory::new();
    }
}
