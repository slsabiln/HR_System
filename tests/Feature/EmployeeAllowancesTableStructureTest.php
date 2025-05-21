<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
class EmployeeAllowancesTableStructureTest extends TestCase
{
    use RefreshDatabase;

   #[Test]
    public function employee_allowances_table_has_expected_columns_and_foreign_key()
    {
        $this->assertTrue(Schema::hasTable('employee_allowances'), 'Table employee_allowances does not exist.');

        $expectedColumns = [
            'id',
            'employee_id',
            'allowance_type',
            'amount',
            'created_at',
            'updated_at',
        ];

        foreach ($expectedColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('employee_allowances', $column),
                "Failed asserting that column '{$column}' exists in employee_allowances table."
            );
        }

        $foreignKeys = DB::select(
            "SELECT CONSTRAINT_NAME 
             FROM information_schema.KEY_COLUMN_USAGE 
             WHERE TABLE_NAME = 'employee_allowances' 
               AND COLUMN_NAME = 'employee_id' 
               AND REFERENCED_TABLE_NAME = 'employees'"
        );

        $this->assertNotEmpty($foreignKeys, 'Foreign key on employee_id referencing employees.id does not exist.');
    }

    #[Test]
    public function test_employee_has_many_allowances()
{
    // أنشئ موظف جديد
    $employee = \App\Models\Employee::factory()->create();
    
dump(\App\Models\EmployeeAllowance::factory()->make()->toArray());

    // أنشئ بدل مرتبط بهذا الموظف، هنا يتم ملء كل الحقول تلقائياً بواسطة المصنع
    $allowance = \App\Models\EmployeeAllowance::factory()
        ->for($employee) // يربط البدل بالموظف
        ->create();

    // تحقق أن الموظف لديه بدل واحد على الأقل
    $this->assertTrue($employee->allowances->contains($allowance));
}

}
