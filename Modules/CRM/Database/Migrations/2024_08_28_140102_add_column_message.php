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
        Schema::table('crm_messages', function (Blueprint $table) {
            $table->json('attachments')->nullable();
            $table->string('email_from')->nullable();
            $table->string('email_for')->nullable();
            $table->enum('status', ['Enviado', 'Recibido', 'Visto'])
                ->default('Enviado')
                ->nullable();
        });

        Schema::table('crm_conversations', function (Blueprint $table) {
            // Cambiar el tipo de campo ENUM para agregar 'chat'
            $table->string('description', 50)->nullable();
            $table->string('type_action', 20)->nullable();
            $table->enum('type_name', ['whatsapp', 'messenger', 'email', 'msgTexto', 'chat'])
                ->default('chat') // Establece un valor predeterminado si es necesario
                ->change();

            $table->enum('status', ['Enviado', 'Recibido', 'En revisión', 'Asignado', 'Investigación', 'Resuelto', 'Cerrado', 'Escalado', 'Rechazado'])
                ->default('Enviado')
                ->nullable()
                ->comment('flujo_normal=Enviado->Recibido->En revisión->Asignado->Investigación->Resuelto->Cerrado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crm_messages', function (Blueprint $table) {
            $table->dropColumn('attachments');
            $table->dropColumn('email_from');
            $table->dropColumn('email_for');
            $table->dropColumn('status');
        });

        Schema::table('crm_conversations', function (Blueprint $table) {
            // Revertir el cambio eliminando 'chat' del ENUM
            $table->dropColumn('status');
            $table->enum('type_name', ['whatsapp', 'messenger', 'email', 'msgTexto'])
                ->default('whatsapp') // Asegúrate de definir el mismo valor predeterminado
                ->change();
            $table->dropColumn('type_action');
            $table->dropColumn('description');
        });
    }
};
