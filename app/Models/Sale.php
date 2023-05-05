<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'local_id',
        'total',
        'advancement',
        'total_discount',
        'payments',
        'petty_cash_id',
        'status'
    ];

    public function saleProduct()
    {
        return $this->hasMany(SaleProduct::class, 'sale_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
