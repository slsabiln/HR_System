<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_employee()
    {
        $data = [
            'full_name' => 'Test User',
            'email' => 'testuser@example.com',
            'code' => 'EMP001',
           
        ];

        $response = $this->postJson('/api/employees', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['full_name' => 'Test User']);

        $this->assertDatabaseHas('employees', ['email' => 'testuser@example.com']);
    }

    #[Test]
    public function can_read_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->getJson('/api/employees/' . $employee->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $employee->id]);
    }

    #[Test]
    public function can_update_employee()
    {
        $employee = Employee::factory()->create([
            'full_name' => 'Old Name',
        ]);

        $updatedData = [
            'full_name' => 'New Name',
            'email' => $employee->email, 
            'code' => $employee->code,
        ];

        $response = $this->putJson('/api/employees/' . $employee->id, $updatedData);

        $response->assertStatus(200)
                 ->assertJsonFragment(['full_name' => 'New Name']);

        $this->assertDatabaseHas('employees', ['full_name' => 'New Name']);
    }

    #[Test]
    public function can_delete_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->deleteJson('/api/employees/' . $employee->id);

        $response->assertStatus(204); 
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
