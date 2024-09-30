<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'description',
        'icon',
        'status',
    ];

    // Indica que el identificador no es autoincrementable
    public $incrementing = false;

    // Especifica el tipo de la clave primaria (en este caso, string)
    protected $keyType = 'string';

    // Define el nombre de la columna clave primaria
    protected $primaryKey = 'identifier';
}
