<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\EmployeeSalaryBase;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeSalaryBaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_cannot_have_two_salary_base_for_same_month()
    {
        $this->expectException(ValidationException::class);

        $employee = Employee::factory()->create();

        EmployeeSalaryBase::create([
            'employee_id' => $employee->id,
            'amount' => 5000,
            'month' => '2025-05',  
        ]);

        EmployeeSalaryBase::create([
            'employee_id' => $employee->id,
            'amount' => 6000,
            'month' => '2025-05',  
        ]);
    }
}

