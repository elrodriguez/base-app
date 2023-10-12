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
        Schema::table('aca_certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('aca_courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aca_certificates', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
};
