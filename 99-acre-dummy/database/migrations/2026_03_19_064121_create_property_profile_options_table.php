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
      Schema::create('property_profile_options', function (Blueprint $table) {
    $table->id();

    $table->string('area_unit')->nullable();
    $table->string('floor_no')->nullable();
    $table->string('availability_status')->nullable();
    $table->string('ownership')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_profile_options');
    }
};
