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
        //
          Schema::table('property_commercials', function (Blueprint $table) {

        $table->string('washrooms')->nullable()->change();
        $table->string('conference_room')->nullable()->change();
        $table->string('reception_area')->nullable()->change();
        $table->string('lifts')->nullable()->change();
        $table->string('parking')->nullable()->change();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
