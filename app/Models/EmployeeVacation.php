<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
class EmployeeVacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'opening_vacations_count',
        'used_vacations_count',
        'remaining_vacations_count',
        'year',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected static function booted()
{
    static::creating(function ($vacation) {
        if ($vacation->opening_vacations_count < 0 || $vacation->used_vacations_count < 0) {
            throw ValidationException::withMessages([
                'vacation_days' => 'Vacation days cannot be negative.'
            ]);
        }
    });

    static::updating(function ($vacation) {
        if ($vacation->opening_vacations_count < 0 || $vacation->used_vacations_count < 0) {
            throw ValidationException::withMessages([
                'vacation_days' => 'Vacation days cannot be negative.'
            ]);
        }
    });
}
}
