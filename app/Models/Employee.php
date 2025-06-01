<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['employee_name', 'email', 'department_id', 'designation_id', 'status', 'image'];
    use HasFactory;
    
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }
}