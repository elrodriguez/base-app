<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academic\Database\factories\AcaSubscriptionTypeFactory;

class AcaSubscriptionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'details',
        'prices',
        'status',
        'period',
        'order_number'
    ];

    protected static function newFactory(): AcaSubscriptionTypeFactory
    {
        //return AcaSubscriptionTypeFactory::new();
    }
}
