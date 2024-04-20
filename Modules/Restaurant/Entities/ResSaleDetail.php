<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Restaurant\Database\factories\ResSaleDetailFactory;

class ResSaleDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sale_id',
        'comanda_id',
        'quantity',
        'price',
        'discount',
        'preparation_status'
    ];

    protected static function newFactory(): ResSaleDetailFactory
    {
        //return ResSaleDetailFactory::new();
    }

    public function comanda(): HasOne
    {
        return $this->hasOne(ResComanda::class, 'id', 'comanda_id');
    }
}
