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
        Schema::table('property_profile_options', function (Blueprint $table) {
            //
         $table->text('quality_ratings')->nullable()->after('property_possesion');
         $table->text('no_of_washroom')->nullable()->after('quality_ratings');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_profile_options', function (Blueprint $table) {
            //
        });
    }
};
