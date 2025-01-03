<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PettyCash extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_opening',
        'time_opening',
        'date_closed',
        'time_closed',
        'beginning_balance',
        'final_balance',
        'income',
        'state',
        'reference_number',
        'local_sale_id',
        'seller_name'
    ];

    public function getDateOpeningAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function getDateClosedAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    public function local(): BelongsTo
    {
        return $this->belongsTo(LocalSale::class, 'local_sale_id');
    }
}
