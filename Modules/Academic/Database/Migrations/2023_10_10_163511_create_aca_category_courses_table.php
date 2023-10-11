<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_category_courses', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->boolean('capacitation')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        DB::table('aca_category_courses')->insert([
            ['description' => 'IMPUESTOS', 'capacitation' => true, 'image' => null],
            ['description' => 'NIIF', 'capacitation' => true, 'image' => null],
            ['description' => 'Otros', 'capacitation' => true, 'image' => null]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_category_courses');
    }
};
