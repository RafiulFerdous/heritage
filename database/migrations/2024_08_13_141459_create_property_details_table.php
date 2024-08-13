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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->integer('number_of_bed')->nullable();
            $table->integer('num_of_bath')->nullable();
            $table->integer('num_of_balcony')->nullable();
            $table->boolean('is_fully_furnished')->nullable();
            $table->double('carpet_area')->nullable();
            $table->string('floor')->nullable();
            $table->string('transection_type')->nullable();
            $table->string('facing')->nullable();
            $table->string('additional_rooms')->nullable();
            $table->string('age_of_construction')->nullable();
            $table->timestamps();


            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_details');
    }
};
