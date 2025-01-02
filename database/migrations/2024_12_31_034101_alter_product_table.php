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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_manufacture_id_foreign');
            $table->dropForeign('products_group_id_foreign');
            $table->dropForeign('products_big_unit_id_foreign');
            $table->dropForeign('products_small_unit_id_foreign');
            $table->dropColumn('manufacture_id');
            $table->dropColumn('group_id');
            $table->dropColumn('big_unit_id');
            $table->dropColumn('small_unit_id');
            $table->foreignId('packing_size_id')->nullable()->constrained('master_data_code_values', 'id');
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
