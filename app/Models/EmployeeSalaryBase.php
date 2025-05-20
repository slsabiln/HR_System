<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
class EmployeeSalaryBase extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'amount',
        'month',
        'year',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function booted()
{
    static::creating(function ($salaryBase) {
        $exists = self::where('employee_id', $salaryBase->employee_id)
            ->where('month', $salaryBase->month)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'month' => 'Salary base for this employee and month already exists.',
            ]);
        }
    });

    static::updating(function ($salaryBase) {
        $exists = self::where('employee_id', $salaryBase->employee_id)
            ->where('month', $salaryBase->month)
            ->where('id', '!=', $salaryBase->id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'month' => 'Salary base for this employee and month already exists.',
            ]);
        }
    });
}
}
