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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_invoice_id')->constrained('customer_invoices');
            $table->string('supplier_name');
            $table->string('supplier_address');
            $table->string('supplier_ref');
            $table->string('number');
            $table->string('date');
            $table->string('term_of_payment');
            $table->string('term_of_delivery');
            $table->integer('ppn');
            $table->double('product_net_rate');
            $table->double('product_total_amount');
            $table->double('product_total_amount_ppn');
            $table->integer('total_quantity_product');
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
