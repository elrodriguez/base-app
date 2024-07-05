<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CRM\Database\factories\CrmChatFactory;

class CrmChat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): CrmChatFactory
    {
        //return CrmChatFactory::new();
    }
}
