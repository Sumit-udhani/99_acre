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
        Schema::table('property_profiles', function (Blueprint $table) {
            //
            $table->text('available_gender')->nullable()->after('furnishing_items');
            $table->text('suitable_for')->nullable()->after('available_gender');
            $table->text('parking')->nullable()->after('suitable_for');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_profiles', function (Blueprint $table) {
            //
        });
    }
};
