<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\EmployeeVacation;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeVacationTest extends TestCase
{
    use RefreshDatabase;

    public function test_opening_vacations_count_cannot_be_negative()
    {
        $this->expectException(ValidationException::class);

        $employee = Employee::factory()->create();

        EmployeeVacation::create([
            'employee_id' => $employee->id,
            'opening_vacations_count' => -3,
            'used_vacations_count' => 0,
        ]);
    }

    public function test_used_vacations_count_cannot_be_negative()
    {
        $this->expectException(ValidationException::class);

        $employee = Employee::factory()->create();

        EmployeeVacation::create([
            'employee_id' => $employee->id,
            'opening_vacations_count' => 10,
            'used_vacations_count' => -2,
        ]);
    }
}

