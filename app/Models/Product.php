<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Sales\Entities\SaleProductBrand;
use Modules\Sales\Entities\SaleProductCategory;

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
        'type_sale_affectation_id',
        'type_purchase_affectation_id',
        'type_unit_measure_id',
        'status',
        'category_id',
        'brand_id',
        'icbper'
    ];

    public function getImageAttribute($value)
    {
        return ($value != 'img/imagen-no-disponible.jpg' ? asset('storage/' . $value) : asset($value));
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(SaleProductCategory::class, 'category_id');
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(SaleProductBrand::class, 'brand_id');
    }


    public function getUniqueSizes()
    {
        // Obtener todos los productos
        $products = Product::where('is_product', true)->where('presentations', true)->get();

        // Crear un array para almacenar las tallas
        $sizes = [];

        foreach ($products as $product) {
            // Decodificar el JSON en un array
            $sizesArray = json_decode($product->sizes, true);

            // Agregar las tallas al array
            foreach ($sizesArray as $size) {
                $sizes[] = $size['size'];
            }
        }

        // Obtener tallas únicas
        $uniqueSizes = array_unique($sizes);

        // Ordenar tallas numéricas y alfabéticas
        sort($uniqueSizes, SORT_STRING); // Ordenar como cadenas

        // Convertir a números si son numéricos
        $sortedSizes = array_map(function ($size) {
            return is_numeric($size) ? (int)$size : $size;
        }, $uniqueSizes);

        sort($sortedSizes, SORT_NUMERIC); // Ordenar numéricamente

        // Retornar tallas únicas y ordenadas
        return array_unique($sortedSizes);
    }
}
