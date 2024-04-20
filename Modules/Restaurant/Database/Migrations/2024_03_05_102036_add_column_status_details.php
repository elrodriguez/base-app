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
        Schema::table('res_sale_details', function (Blueprint $table) {
            $table->enum('preparation_status', ['pendiente', 'listo'])->default('pendiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('res_sale_details', function (Blueprint $table) {
            $table->dropColumn('preparation_status');
        });
    }
};
