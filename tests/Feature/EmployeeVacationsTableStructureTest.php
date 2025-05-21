<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class EmployeeVacationsTableStructureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function employee_vacations_table_has_expected_columns_and_foreign_key()
    {
        $this->assertTrue(Schema::hasTable('employee_vacations'), 'Table employee_vacations does not exist.');

        $expectedColumns = [
            'id',
            'employee_id',
            'opening_vacations_count',
            'used_vacations_count',
            'created_at',
            'updated_at',
        ];

        foreach ($expectedColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('employee_vacations', $column),
                "Failed asserting that column '{$column}' exists in employee_vacations table."
            );
        }

        // تحقق من وجود المفتاح الأجنبي (Foreign Key) للعمود employee_id
        $foreignKeys = DB::select(
            "SELECT CONSTRAINT_NAME 
             FROM information_schema.KEY_COLUMN_USAGE 
             WHERE TABLE_NAME = 'employee_vacations' 
               AND COLUMN_NAME = 'employee_id' 
               AND REFERENCED_TABLE_NAME = 'employees'"
        );

        $this->assertNotEmpty($foreignKeys, 'Foreign key on employee_id referencing employees.id does not exist.');
    }
    #[Test]
    public function test_employee_has_many_vacations()
    {
        $employee = \App\Models\Employee::factory()->create();

        $vacation = \App\Models\EmployeeVacation::factory()
            ->for($employee)
            ->create();

        $this->assertTrue($employee->vacations->contains($vacation));
    }
}
