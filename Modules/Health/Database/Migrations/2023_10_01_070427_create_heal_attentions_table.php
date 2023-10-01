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
        Schema::create('heal_attentions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id');
            $table->integer('age');
            $table->enum('age_type', ['días', 'semanas', 'meses', 'años']);
            $table->time('hour');
            $table->string('who_takes_care_of_child', 300)->nullable()->comment('quien cuida al niño');
            $table->boolean('father_involvement')->default(false)->comment('participación del padre en el cuidado del niño');
            $table->boolean('affection_child')->default(false)->comment('el niño resibe muestras de afecto');
            $table->string('information', 300)->nullable()->comment('especifique trato al niño');
            $table->string('reason', 500)->nullable()->comment('motivo de la consulta medica');
            $table->timestamps();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heal_attentions');
    }
};
