<?php

namespace Modules\Socialevents\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Socialevents\Database\factories\EvenEventTickeClientFactory;

class EvenEventTicketClient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): EvenEventTickeClientFactory
    {
        //return EvenEventTickeClientFactory::new();
    }
}
