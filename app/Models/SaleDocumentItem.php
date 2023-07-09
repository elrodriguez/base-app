<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDocumentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'cod_product',
        'decription_product',
        'unit_type',
        'quantity',
        'mto_base_igv',
        'percentage_igv',
        'igv',
        'total_tax',
        'type_afe_igv',
        'icbper',
        'factor_icbper',
        'mto_value_sale',
        'mto_value_unit',
        'mto_price_unit',
        'mto_total'
    ];
}
