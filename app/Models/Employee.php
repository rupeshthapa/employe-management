<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['employee_name', 'email', 'department_id', 'designation_id', 'phone', 'address', 'gender', 'status', 'joined_date', 'basic_salary', 'image'];
    use HasFactory;
    
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }

}