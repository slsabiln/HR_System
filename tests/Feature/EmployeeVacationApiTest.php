<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\EmployeeVacation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class EmployeeVacationApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_employee_vacation()
    {
        $employee = Employee::factory()->create();

        $data = [
            'employee_id' => $employee->id,
            'vacation_type' => 'Annual',
            'start_date' => '2025-06-01',
            'end_date' => '2025-06-10',
        ];

        $response = $this->postJson('/api/employee-vacations', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['vacation_type' => 'Annual']);

        $this->assertDatabaseHas('employee_vacations', [
            'employee_id' => $employee->id,
            'vacation_type' => 'Annual',
        ]);
    }

    #[Test]
    public function can_get_single_employee_vacation()
    {
        $vacation = EmployeeVacation::factory()->create();

        $response = $this->getJson('/api/employee-vacations/' . $vacation->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $vacation->id]);
    }

    #[Test]
    public function can_update_employee_vacation()
    {
        $vacation = EmployeeVacation::factory()->create([
            'vacation_type' => 'Sick',
            'start_date' => '2025-06-01',
            'end_date' => '2025-06-05',
        ]);

        $response = $this->putJson('/api/employee-vacations/' . $vacation->id, [
            'vacation_type' => 'Annual',
            'start_date' => '2025-07-01',
            'end_date' => '2025-07-10',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['vacation_type' => 'Annual']);

        $this->assertDatabaseHas('employee_vacations', [
            'id' => $vacation->id,
            'vacation_type' => 'Annual',
        ]);
    }

    #[Test]
    public function can_delete_employee_vacation()
    {
        $vacation = EmployeeVacation::factory()->create();

        $response = $this->deleteJson('/api/employee-vacations/' . $vacation->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('employee_vacations', ['id' => $vacation->id]);
    }

    #[Test]
    public function can_list_all_employee_vacations()
    {
        EmployeeVacation::factory()->count(3)->create();

        $response = $this->getJson('/api/employee-vacations');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}
