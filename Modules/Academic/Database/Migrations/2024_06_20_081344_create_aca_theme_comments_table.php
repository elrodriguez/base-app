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
        Schema::create('aca_theme_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->unsignedBigInteger('theme_id')->nullable();
            $table->longText('description');
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->integer('i_like')->default(0);
            $table->integer('not_like')->default(0);
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('aca_courses')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('aca_modules')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('aca_themes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('aca_theme_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aca_theme_comments');
    }
};
