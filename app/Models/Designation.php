<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = ['name'];
    use HasFactory;

    public function employees()
{
    return $this->hasMany(Employee::class);
}

}
