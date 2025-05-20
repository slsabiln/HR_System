<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAllowance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'allowance_type',
        'amount',
        'effective_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
