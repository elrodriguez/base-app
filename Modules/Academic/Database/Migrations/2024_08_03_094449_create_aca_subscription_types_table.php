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
        Schema::create('aca_subscription_types', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('description', 300)->nullable();
            $table->json('details')->nullable();
            $table->json('prices')->nullable();
            $table->timestamps();
            $table->string('status', 1)->default(1);
        });

        Schema::table('aca_cap_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->foreign('subscription_id')->references('id')->on('aca_subscription_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aca_subscription_types');
    }
};
