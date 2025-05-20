<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
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

    protected static function booted()
{
    static::creating(function ($employee) {
        if (Employee::where('code', $employee->code)->exists()) {
            throw ValidationException::withMessages([
                'code' => 'The employee code must be unique.',
            ]);
        }
    });

    static::updating(function ($employee) {
        if (Employee::where('code', $employee->code)
            ->where('id', '!=', $employee->id)
            ->exists()
        ) {
            throw ValidationException::withMessages([
                'code' => 'The employee code must be unique.',
            ]);
        }
    });

     static::deleting(function ($employee) {
        $employee->vacations()->delete();
        $employee->allowances()->delete();
        $employee->salaryBases()->delete();
    });
}
}
