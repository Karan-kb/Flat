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
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->unsignedBigInteger('flat_id');
            $table->integer('water_rating')->nullable();
            $table->integer('location_rating')->nullable();
            $table->integer('price_rating')->nullable();
            $table->integer('transportation_rating')->nullable();
            $table->integer('cleanliness_rating')->nullable();
            $table->double('average')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
