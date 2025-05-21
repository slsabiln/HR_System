<?php

namespace Tests\Unit;

use App\Models\Employee;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeVacation;
use App\Models\EmployeeSalaryBase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
class EmployeeModelTest extends TestCase
{
    use RefreshDatabase;

     #[Test]
    public function fillable_fields_are_set_correctly()
    {
        $employee = new Employee();

        $this->assertEquals([
            'code',
            'full_name',
            'email',
            'phone',
            'position',
            'department',
        ], $employee->getFillable());
    }

     #[Test]
    public function employee_has_many_vacations()
    {
        $employee = Employee::factory()->create();
        $vacation = $employee->vacations()->create([
            'opening_vacations_count' => 20,
            'used_vacations_count' => 5,
        ]);

        $this->assertTrue($employee->vacations->contains($vacation));
    }

     #[Test]
    public function employee_has_many_allowances()
    {
        $employee = Employee::factory()->create();
        $allowance = $employee->allowances()->create([
            'type' => 'housing',
            'amount' => 1500,
        ]);

        $this->assertTrue($employee->allowances->contains($allowance));
    }

     #[Test]
    public function employee_has_many_salary_bases()
    {
        $employee = Employee::factory()->create();
        $salaryBase = $employee->salaryBases()->create([
            'month' => '2024-05',
            'amount' => 8000,
        ]);

        $this->assertTrue($employee->salaryBases->contains($salaryBase));
    }
}
