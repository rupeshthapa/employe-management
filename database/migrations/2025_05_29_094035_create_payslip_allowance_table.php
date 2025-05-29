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
        Schema::create('payslip_allowance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payslip_id')->constrained('payslips')->onDelete('cascade');
            $table->foreignId('allowance_id')->constrained('allowances')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslip_allowance');
    }
};
