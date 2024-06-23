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
        Schema::create('dent_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('correlative')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('patient_person_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('doctor_person_id');
            $table->date('date_appointmen')->nullable();
            $table->time('time_appointmen')->nullable();
            $table->date('date_end_appointmen')->nullable();
            $table->time('time_end_appointmen')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('description')->nullable();
            $table->string('details')->nullable();
            $table->string('message', 500)->nullable();
            $table->char('status', 1)->default(1)->comment('1=pendiente,2=atendido,0=cancelado');
            $table->boolean('important')->default(false);
            $table->unsignedBigInteger('created_user_id');
            $table->unsignedBigInteger('updated_user_id');
            $table->string('sick_time', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dent_appointments');
    }
};
