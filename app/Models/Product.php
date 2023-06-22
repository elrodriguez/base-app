<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'usine',
        'interne',
        'description',
        'image',
        'purchase_prices',
        'sale_prices',
        'sizes',
        'stock_min',
        'stock',
        'presentations',
        'is_product',
        'type_affectation'
    ];

    public function getImageAttribute($value)
    {
        return ($value != 'img/imagen-no-disponible.jpg' ? asset('storage/' . $value) : asset($value));
    }
}
