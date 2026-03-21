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
            $table->string('furnishing_items')->nullable()->after('broker_contact');
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
