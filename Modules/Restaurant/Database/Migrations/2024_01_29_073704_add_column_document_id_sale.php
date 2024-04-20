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
        Schema::table('res_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id')->nullable();
            $table->string('entity_name_document')->nullable();
            $table->string('type_name_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('res_sales', function (Blueprint $table) {
            $table->dropColumn('type_name_document');
            $table->dropColumn('entity_name_document');
            $table->dropColumn('document_id');
        });
    }
};
