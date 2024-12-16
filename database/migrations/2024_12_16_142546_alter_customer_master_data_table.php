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
        Schema::table('customer_segments', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->string('description');
        });
        Schema::table('customer_categories', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->string('description');
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
