<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\EmployeeVacation;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeSalaryBase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeCascadeDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_deleting_employee_cascades_to_related_records()
    {
        $employee = Employee::factory()->create();

        $vacation = EmployeeVacation::factory()->create(['employee_id' => $employee->id]);
        $allowance = EmployeeAllowance::factory()->create(['employee_id' => $employee->id]);
        $salaryBase = EmployeeSalaryBase::factory()->create(['employee_id' => $employee->id]);
        $employee->delete();

        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
        $this->assertDatabaseMissing('employee_vacations', ['id' => $vacation->id]);
        $this->assertDatabaseMissing('employee_allowances', ['id' => $allowance->id]);
        $this->assertDatabaseMissing('employee_salary_bases', ['id' => $salaryBase->id]);

    }
}
