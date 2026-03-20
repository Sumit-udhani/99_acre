<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_profiles', function (Blueprint $table) {

            $table->string('property_age')->nullable()->after('ownership');

            $table->date('property_date')->nullable()->after('property_age');

            $table->string('rent_out')->nullable()->after('property_date');

            $table->string('agreement_type')->nullable()->after('rent_out');

            $table->string('broker_contact')->nullable()->after('agreement_type');

        });
    }

    public function down(): void
    {
        Schema::table('property_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'property_age',
                'property_date',
                'rent_out',
                'agreement_type',
                'broker_contact'
            ]);

        });
    }
};
