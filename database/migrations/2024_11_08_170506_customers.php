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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained("areas");
            $table->foreignId("customer_segment_id")->constrained("customer_segments");
            $table->foreignId('customer_category_id')->constrained("customer_categories");
            $table->foreignId('customer_group_id')->nullable()->constrained("customer_groups");
            $table->string("code")->nullable();
            $table->string("name");
            $table->string("company_name");
            $table->string("npwp")->nullable();
            $table->string("npwp_name")->nullable();
            $table->string("npwp_address")->nullable();
            $table->string("nppkp")->nullable();
            $table->string("outlet_name")->nullable();
            $table->string("alias")->nullable();
            $table->string("status")->nullable();
            $table->string("address")->nullable();
            $table->string("address_number")->nullable();
            $table->string("rt_rw")->nullable();
            $table->string("province")->nullable();
            $table->string("district")->nullable();
            $table->string("sub_district")->nullable();
            $table->string("village")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("contact_person_name")->nullable();
            $table->string("contact_person_phone")->nullable();
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
        Schema::dropIfExists('customers');
    }
};
