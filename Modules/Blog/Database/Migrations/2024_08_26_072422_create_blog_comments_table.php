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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->binary('message');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('article_id');
            $table->integer('appreciate')->nullable()->default(0)->comment('para que los usuarios le den valor al comentario');
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->timestamps();
            $table->foreign('comment_id')->references('id')->on('blog_comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('blog_articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
