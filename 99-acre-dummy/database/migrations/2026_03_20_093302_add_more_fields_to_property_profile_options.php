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
            $table->string('furnishing')->nullable()->after('ownership');
              $table->string('rent_out')->nullable()->after('furnishing');
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
