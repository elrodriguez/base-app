<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'address',
        'phone'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'local_id');
    }
}
