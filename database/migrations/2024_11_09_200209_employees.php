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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained("users");
            $table->foreignId('sub_department_id')->constrained("sub_departments");
            $table->foreignId('level_grade_id')->constrained("level_grades");
            $table->string('nik')->unique()->nullable();
            $table->dateTime('join_date')->nullable();
            $table->dateTime('date_of_exchange_status')->nullable();
            $table->string('position')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
