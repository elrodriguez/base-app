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
        Schema::create('aca_cap_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('aca_students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('aca_courses')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('aca_type_students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_cap_registrations');
    }
};
