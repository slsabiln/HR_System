<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmployeeSalaryBaseTableStructureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_salary_bases_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasTable('employee_salary_bases'), 'Table employee_salary_bases does not exist.');

        $expectedColumns = [
            'id',
            'employee_id',
            'month',
            'amount',
            'created_at',
            'updated_at',
        ];

        foreach ($expectedColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('employee_salary_bases', $column),
                "Column {$column} does not exist in employee_salary_bases table."
            );
        }
    }
/** @test */
    public function test_employee_has_many_salary_bases()
{
    $employee = \App\Models\Employee::factory()->create();

    $salaryBase = \App\Models\EmployeeSalaryBase::factory()
        ->for($employee)
        ->create();

    $this->assertTrue($employee->salaryBases->contains($salaryBase));
}

}
