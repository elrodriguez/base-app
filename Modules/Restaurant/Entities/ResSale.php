<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Restaurant\Database\factories\ResSaleFactory;

class ResSale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sale_date',
        'sale_hour',
        'correlative',
        'petty_cash_id',
        'user_id',
        'person_id',
        'local_id',
        'total',
        'total_discount',
        'payments',
        'queue_status',
        'document_id',
        'entity_name_document',
        'type_name_document'
    ];

    protected static function newFactory(): ResSaleFactory
    {
        //return ResSaleFactory::new();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastSale = self::latest('id')->first();

            if ($lastSale) {
                $lastCorrelative = $lastSale->correlative;

                // Extraer el número actual de correlative
                $lastNumber = (int) substr($lastCorrelative, 2);

                // Incrementar el número
                $newNumber = $lastNumber + 1;

                // Generar el nuevo correlative con formato RV000000X
                $model->correlative = 'RV' . str_pad($newNumber, 10, '0', STR_PAD_LEFT);
            } else {
                // Si no hay registros anteriores, usar RV0000001
                $model->correlative = 'RV0000000001';
            }
        });
    }
    public function details(): HasMany
    {
        return $this->hasMany(ResSaleDetail::class, 'sale_id');
    }
}
