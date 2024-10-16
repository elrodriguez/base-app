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
        Schema::create('dent_attentions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time_attention');
            $table->string('current_illness', 300)->nullable()->comment('enfermedad actual');
            $table->text('reason_consultation')->nullable()->comment('motivo de consulta');
            $table->text('sick_time')->nullable()->comment('Tiempo de Enfermedad');
            $table->integer('age')->nullable()->comment('edad');
            $table->string('appetite', 100)->nullable()->comment('apetito');
            $table->string('thirst', 100)->nullable()->comment('sed');
            $table->string('dream', 100)->nullable()->comment('sueño');
            $table->string('mood', 100)->nullable()->comment('estado de animo');
            $table->string('urine', 100)->nullable()->comment('orina');
            $table->string('depositions', 100)->nullable()->comment('deposiciones');
            $table->string('weight_loss', 100)->nullable()->comment('perdida de peso');
            $table->string('pex_tem', 100)->nullable()->comment('examen fisico T');
            $table->string('pex_pa', 100)->nullable()->comment('examen fisico PA');
            $table->string('pex_fc', 100)->nullable()->comment('examen fisico FC');
            $table->string('pex_fr', 100)->nullable()->comment('examen fisico FR');
            $table->string('pex_peso', 100)->nullable()->comment('examen fisico peso');
            $table->string('pex_talla', 100)->nullable()->comment('examen fisico talla');
            $table->string('pex_imc', 100)->nullable()->comment('examen fisico IMC');
            $table->text('treatment')->nullable()->comment('tratamiento');
            $table->json('pex_aux_examination')->nullable()->comment('examen auxiliar,descripcion,lugar,motivo');
            $table->unsignedBigInteger('doctor_id')->nullable()->comment('doctor que atendio');
            $table->unsignedBigInteger('user_id')->comment('usuario que registro');
            $table->unsignedBigInteger('patient_id')->comment('pasiente');
            $table->unsignedBigInteger('appointment_id')->nullable()->comment('atendido en la cita');
            $table->unsignedBigInteger('next_appointment_id')->nullable()->comment('proxima cita');
            $table->boolean('signed_accepted')->default(false)->comment('firmado aceptado');
            $table->text('observations')->nullable()->comment('observaciones');
            $table->unsignedBigInteger('history_id')->comment('id historia clinica');
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('heal_doctors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('heal_patients')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('dent_appointments')->onDelete('cascade');
            $table->foreign('next_appointment_id')->references('id')->on('dent_appointments')->onDelete('cascade');
            $table->foreign('history_id')->references('id')->on('heal_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dent_attentions');
    }
};
