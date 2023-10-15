<?php

namespace Modules\Onlineshop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnliSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_name',
        'person_id',
        'total',
        'transaction_amount',
        'installments',
        'email',
        'clie_full_name',
        'identification_type',
        'identification_number',
        'token',
        'response_status',
        'response_status_detail',
        'response_id',
        'response_date_approved',
        'response_payer',
        'response_payment_method_id',
        'response_credit_card',
        'response_refunds'
    ];

    protected static function newFactory()
    {
        return \Modules\Onlineshop\Database\factories\OnliSaleFactory::new();
    }
}
