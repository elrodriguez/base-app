<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('presentations')->default(true);
            $table->boolean('is_product')->default(true);
            $table->char('type_affectation_id', 2)->default('10');
            $table->string('type_unit_measure_id')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type_unit_measure_id');
            $table->dropColumn('type_affectation_id');
            $table->dropColumn('is_product');
            $table->dropColumn('presentations');
        });
    }
};
