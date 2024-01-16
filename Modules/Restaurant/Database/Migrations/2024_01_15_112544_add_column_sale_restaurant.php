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
            $table->string('queue_status', 2)->nullable()->comment('01=pendiente,02=atendido,03=cobrar,04=pagado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('res_sales', function (Blueprint $table) {
            $table->dropColumn('queue_status');
        });
    }
};
