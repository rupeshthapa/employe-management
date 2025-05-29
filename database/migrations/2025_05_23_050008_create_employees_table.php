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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('email')->unique();
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('designation_id')->constrained('designations');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('status', ['active', 'inactive']);
            $table->date('joined_date');
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
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
