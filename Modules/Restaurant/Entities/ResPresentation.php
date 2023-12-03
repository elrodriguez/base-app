<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Restaurant\Database\factories\ResPresentationFactory;

class ResPresentation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'icon', 'description'
    ];

    protected static function newFactory(): ResPresentationFactory
    {
        //return ResPresentationFactory::new();
    }
}
