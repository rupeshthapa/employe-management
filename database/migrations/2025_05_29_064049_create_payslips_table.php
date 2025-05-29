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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('payroll_id')->nullable()->constrained('payrolls')->onDelete('set null');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('overtime', 10, 2)->default(0);
            $table->decimal('deduction', 10, 2)->default(0);
            $table->decimal('net_salary', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
