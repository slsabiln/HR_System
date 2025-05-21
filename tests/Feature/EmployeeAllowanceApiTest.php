<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\EmployeeAllowance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class EmployeeAllowanceApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_employee_allowance()
    {
        $employee = Employee::factory()->create();

        $data = [
            'employee_id'    => $employee->id,
            'allowance_type' => 'Transport',
            'amount'         => 500.00,
        ];

        $response = $this->postJson('/api/employee-allowances', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['allowance_type' => 'Transport']);

        $this->assertDatabaseHas('employee_allowances', [
            'employee_id'    => $employee->id,
            'allowance_type' => 'Transport',
            'amount'         => 500.00,
        ]);
    }

    #[Test]
    public function can_get_single_employee_allowance()
    {
        $allowance = EmployeeAllowance::factory()->create();

        $response = $this->getJson('/api/employee-allowances/' . $allowance->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $allowance->id]);
    }

    #[Test]
    public function can_update_employee_allowance()
    {
        $allowance = EmployeeAllowance::factory()->create([
            'allowance_type' => 'Housing',
            'amount'         => 1000,
        ]);

        $response = $this->putJson('/api/employee-allowances/' . $allowance->id, [
            'allowance_type' => 'Food',
            'amount'         => 750,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['allowance_type' => 'Food']);

        $this->assertDatabaseHas('employee_allowances', [
            'id'             => $allowance->id,
            'allowance_type' => 'Food',
            'amount'         => 750,
        ]);
    }

    #[Test]
    public function can_delete_employee_allowance()
    {
        $allowance = EmployeeAllowance::factory()->create();

        $response = $this->deleteJson('/api/employee-allowances/' . $allowance->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('employee_allowances', ['id' => $allowance->id]);
    }

    #[Test]
    public function can_list_all_employee_allowances()
    {
        EmployeeAllowance::factory()->count(3)->create();

        $response = $this->getJson('/api/employee-allowances');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}
