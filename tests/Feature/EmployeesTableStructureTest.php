<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmployeesTableStructureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employees_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasTable('employees'), 'Table employees does not exist.');

        $expectedColumns = [
            'id',
            'code',
            'full_name',
            'email',
            'phone',
            'position',
            'department',
            'hired_at',
            'created_at',
            'updated_at',
        ];

        foreach ($expectedColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('employees', $column),
                "Failed asserting that column '{$column}' exists in employees table."
            );
        }
    }
}
