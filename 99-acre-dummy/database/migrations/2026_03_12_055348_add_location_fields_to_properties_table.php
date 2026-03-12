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
        Schema::table('properties', function (Blueprint $table) {
            //
            //  $table->foreignId('user_id')
            //       ->nullable()
            //   ->after('id')
            //   ->constrained()
            //   ->cascadeOnDelete();

        $table->string('city')->nullable();
        $table->string('locality')->nullable();
        $table->string('sub_locality')->nullable();
        $table->text('address')->nullable();

        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('properties', function (Blueprint $table) {

        $table->dropForeign(['user_id']);
        $table->dropColumn([
            'user_id',
            'city',
            'locality',
            'sub_locality',
            'address',
            'latitude',
            'longitude'
        ]);

    });
    }
};
