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
            $table->text('boundary_wall')->nullable()->after('room_type');
            $table->text('open_sides')->nullable()->after('boundary_wall');
            $table->text('is_construction')->nullable()->after('open_sides');
            $table->text('property_possesion')->nullable()->after('is_construction');


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
