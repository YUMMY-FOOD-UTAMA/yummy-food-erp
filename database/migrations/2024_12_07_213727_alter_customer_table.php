<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn("province");
            $table->dropColumn("district");
            $table->dropColumn("sub_district");
            $table->dropColumn("village");
            $table->dropColumn("postal_code");
            $table->foreignId('province_id')->nullable()->constrained("provinces");
            $table->foreignId('district_id')->nullable()->constrained("districts");
            $table->foreignId('sub_district_id')->nullable()->constrained("sub_districts");
            $table->foreignId('sub_district_village_id')->nullable()->constrained("sub_district_villages");
            $table->string('department')->nullable();
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
