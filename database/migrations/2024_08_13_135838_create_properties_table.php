<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type')->nullable()->comment('1=land, 2=apartment');
            $table->string('location');
            $table->float('min_value')->nullable();
            $table->float('max_value')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->nullable()->comment("something");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
