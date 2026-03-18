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
        Schema::create('property_profiles', function (Blueprint $table) {
            $table->id();
         

            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('balconies')->nullable();
    // Area
    $table->integer('carpet_area')->nullable();
    $table->string('area_unit')->default('sqft');
    $table->integer('builtup_area')->nullable();
    $table->integer('super_builtup_area')->nullable();

    // Rooms

    // Floor
    $table->integer('total_floors')->nullable();
    $table->string('floor_no')->nullable(); // Ground, 1, 2, etc.

    // Status
    $table->string('availability_status')->nullable(); // ready, under construction

    $table->string('ownership')->nullable(); // freehold etc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_profiles');
    }
};
