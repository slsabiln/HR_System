<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'full_name',
        'email',
        'phone',
        'position',
        'department',
    ];

    public function vacations()
    {
        return $this->hasMany(EmployeeVacation::class);
    }

    public function allowances()
    {
        return $this->hasMany(EmployeeAllowance::class);
    }

    public function salaryBases()
    {
        return $this->hasMany(EmployeeSalaryBase::class);
    }
}
