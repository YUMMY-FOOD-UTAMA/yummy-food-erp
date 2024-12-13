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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->foreignId('brand_id')->constrained('master_data_code_values', 'id');
            $table->foreignId('division_id')->constrained('master_data_code_values', 'id');
            $table->foreignId('category_id')->constrained('master_data_code_values', 'id');
            $table->foreignId('group_id')->constrained('master_data_code_values', 'id');
            $table->foreignId('type_id')->constrained('master_data_code_values', 'id');
            $table->foreignId('manufacture_id')->constrained('master_data_code_values', 'id');
            $table->foreignId('small_unit_id')->nullable()->constrained('master_data_code_values', 'id');
            $table->foreignId('big_unit_id')->nullable()->constrained('master_data_code_values', 'id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
