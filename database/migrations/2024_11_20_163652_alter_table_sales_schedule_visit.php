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
        Schema::table('sales_schedule_visits', function (Blueprint $table) {
            $table->string("customer_feedback")->nullable();
            $table->string("customer_request_product_new")->nullable();
            $table->string("visit_location")->nullable();
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
