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
        Schema::table('onli_items', function (Blueprint $table) {
            $table->string('additional')->nullable();
            $table->string('additional1')->nullable();
            $table->string('additional2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onli_items', function (Blueprint $table) {
            $table->dropColumn('additional2');
            $table->dropColumn('additional1');
            $table->dropColumn('additional');
        });
    }
};
