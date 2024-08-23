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
        Schema::table('aca_cap_registrations', function (Blueprint $table) {
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->boolean('unlimited')->default(true)->nullable();
        });

        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->integer('order_number')->default(1)->nullable();
            $table->enum('period', ['Mensual', 'Trimestral', 'Semestral', 'Anual', 'Diario', 'Semanal', 'Prueba gratuita', 'Única Vez'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aca_cap_registrations', function (Blueprint $table) {
            $table->dropColumn('date_start');
            $table->dropColumn('date_end');
            $table->dropColumn('unlimited');
        });

        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->dropColumn('period');
            $table->dropColumn('order_number');
        });
    }
};
