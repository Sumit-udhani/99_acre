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
        Schema::table('property_location_types', function (Blueprint $table) {
            //
              // First drop foreign key
            $table->dropForeign(['category_id']);
            
            // Then drop column
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_location_types', function (Blueprint $table) {
            //
              $table->foreignId('category_id')
                  ->constrained('property_categories')
                  ->onDelete('cascade');
        });
    }
};
