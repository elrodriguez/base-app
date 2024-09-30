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
        Schema::table('model_has_permissions', function (Blueprint $table) {
            // Eliminar la clave primaria compuesta temporalmente
            $table->dropIndex('model_has_permissions_model_id_model_type_index');

            // Cambiar el tipo de model_id a VARCHAR
            $table->string('model_id', 255)->change();

            // Volver a agregar la clave primaria compuesta
            $table->index(['model_id', 'model_type'], 'model_has_permissions_model_id_model_type_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->dropIndex('model_has_permissions_model_id_model_type_index');

            // Revertir el tipo de model_id a su tipo original (ajustar según sea necesario)
            $table->bigInteger('model_id')->change();

            // Volver a agregar la clave primaria compuesta
            $table->index(['model_id', 'model_type'], 'model_has_permissions_model_id_model_type_index');
        });
    }
};
