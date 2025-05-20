<?php

namespace Tests\Feature;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

public function test_employee_code_must_be_unique_via_validation()
{
    $this->expectException(\Illuminate\Validation\ValidationException::class);

    $code = 'EMP001';

    Employee::create([
        'full_name' => 'First Employee',
        'email' => 'first@example.com',
        'code' => $code,
    ]);

    // نفترض أن هناك منطق validation مضاف:
    $employee = new Employee([
        'full_name' => 'Second Employee',
        'email' => 'second@example.com',
        'code' => $code,
    ]);

    $employee->save();
}


}
