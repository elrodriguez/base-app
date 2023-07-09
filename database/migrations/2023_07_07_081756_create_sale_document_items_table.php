<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_document_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->string('cod_product');
            $table->string('decription_product');
            $table->string('unit_type')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->decimal('mto_base_igv', 10, 2)->nullable();
            $table->decimal('percentage_igv', 10, 2)->nullable();
            $table->decimal('igv')->nullable();
            $table->decimal('total_tax', 10, 2)->nullable();
            $table->string('type_afe_igv')->nullable();
            $table->decimal('icbper', 10, 2)->nullable()->comment('impuesto a la bolsa plastica');
            $table->decimal('factor_icbper', 10, 2)->nullable()->comment('(cantidad)*(factor ICBPER)');
            $table->decimal('mto_value_sale', 10, 2)->nullable();
            $table->decimal('mto_value_unit', 10, 2)->nullable();
            $table->decimal('mto_price_unit', 10, 2)->nullable();
            $table->decimal('mto_total', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('document_id')->references('id')->on('sale_documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_document_items');
    }
};
