<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_name',
        'full_name',
        'description',
        'document_type_id',
        'number',
        'telephone',
        'email',
        'image',
        'address',
        'is_provider',
        'is_client',
        'contact_telephone',
        'contact_name',
        'contact_email',
        'ubigeo'
    ];

    public function getImageAttribute($value)
    {
        return ($value != 'img/imagen-no-disponible.jpeg' ? asset('storage/' . $value) : asset($value));
    }
    public function district(): HasOne
    {
        return $this->hasOne(District::class, 'id', 'ubigeo');
    }
}
