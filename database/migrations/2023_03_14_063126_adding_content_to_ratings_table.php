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
        Schema::table('ratings', function (Blueprint $table) {
            //
            $table->integer('water_rating')->nullable();
            $table->integer('location_rating')->nullable();
            $table->integer('price_rating')->nullable();
            $table->integer('transportation_rating')->nullable();
            $table->integer('cleanliness_rating')->nullable();
            $table->text('comment')->nullable();
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
