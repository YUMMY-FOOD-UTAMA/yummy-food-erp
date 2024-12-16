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
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign('areas_sub_region_id_foreign');
            $table->dropColumn('sub_region_id');
        });

        Schema::drop('sub_regions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
