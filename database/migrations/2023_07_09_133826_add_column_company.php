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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('ubigeo')->nullable();
            $table->foreign('ubigeo', 'company_ubigeo_fk')->references('id')->on('districts');
        });
        Schema::table('local_sales', function (Blueprint $table) {
            $table->string('ubigeo')->nullable();
            $table->foreign('ubigeo', 'local_sale_ubigeo_fk')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('company_ubigeo_fk');
            $table->dropColumn('ubigeo');
        });
        Schema::table('local_sales', function (Blueprint $table) {
            $table->dropForeign('local_sale_ubigeo_fk');
            $table->dropColumn('ubigeo')->nullable();
        });
    }
};
