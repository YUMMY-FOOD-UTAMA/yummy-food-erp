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
        Schema::create('schedule_visit_request_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_visit_id')->constrained("schedule_visits");
            $table->foreignId('product_id')->constrained("products");
            $table->integer('quantity');
            $table->string("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_visit_request_products');
    }
};
