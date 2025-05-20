<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
