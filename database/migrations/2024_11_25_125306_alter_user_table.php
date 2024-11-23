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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('province_id')->nullable()->constrained("provinces");
            $table->foreignId('district_id')->nullable()->constrained("districts");
            $table->foreignId('sub_district_id')->nullable()->constrained("sub_districts");
            $table->foreignId('sub_district_village_id')->nullable()->constrained("sub_district_villages");
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
