<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'document',
        'amount',
        'petty_cash_id'
    ];

    public function cash(): BelongsTo
    {
        return $this->belongsTo(PettyCash::class, 'petty_cash_id');
    }
}
