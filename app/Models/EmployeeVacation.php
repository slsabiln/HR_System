<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
