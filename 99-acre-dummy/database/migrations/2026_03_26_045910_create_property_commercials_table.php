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
        Schema::create('property_commercials', function (Blueprint $table) {
            $table->id();
               $table->foreignId('property_id')
              ->constrained()
              ->cascadeOnDelete();

        // 🏢 OFFICE DETAILS
        $table->integer('min_seats')->nullable();
        $table->integer('max_seats')->nullable();
        $table->integer('cabins')->nullable();
        $table->integer('meeting_rooms')->nullable();

        // 🧼 FACILITIES
        $table->boolean('washrooms')->nullable();
        $table->boolean('conference_room')->nullable();
        $table->boolean('reception_area')->nullable();

        // 🍽 PANTRY
        $table->enum('pantry_type', ['private', 'shared', 'none'])->nullable();

        // 🛗 OTHER
        $table->integer('lifts')->nullable();
        $table->string('parking')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_commercials');
    }
};
