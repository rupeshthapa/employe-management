<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    protected $table = 'payslips';
    protected $fillable = ['employee_id', 'payroll_id', 'overtime', 'bonus_id', 'deduction', 'gross_salary', 'net_salary', 'tax'];

    use HasFactory;

    public function employee() {
    return $this->belongsTo(Employee::class);
}

public function payroll() {
    return $this->belongsTo(Payroll::class);
}

public function bonus() {
    return $this->belongsTo(Bonus::class);
}

}
