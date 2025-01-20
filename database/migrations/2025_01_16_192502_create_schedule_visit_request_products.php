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
        Schema::create('sales_schedule_visit_request_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_schedule_visit_id')->constrained("sales_schedule_visits","id","sales_sched_visit_req_product_fk")->onDelete('cascade');
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
