<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;
use PHPUnit\Framework\Attributes\Test;
class YourEndpointTest extends TestCase
{
     #[Test]
public function can_get_total_monthly_salary()
{
    $employee = Employee::factory()->create();

    $employee->salaryBases()->create(['amount' => 3000]);
    $employee->allowances()->create(['amount' => 500]);
    $employee->allowances()->create(['amount' => 200]);

    $response = $this->getJson('/api/employees/'.$employee->id.'/salary');

    $response->assertStatus(200)
             ->assertJson(['total_monthly_salary' => 3700]);
}

}
