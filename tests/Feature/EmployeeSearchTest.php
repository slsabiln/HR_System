<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use App\Http\Controllers\Api\Request; 
class EmployeeSearchTest extends TestCase
{
    use RefreshDatabase;
    #[Test]
    public function can_search_employees()
    {
        
        Employee::factory()->create(['full_name' => 'John Doe', 'code' => 'JD123', 'email' => 'john@example.com']);
        Employee::factory()->create(['full_name' => 'Jane Smith', 'code' => 'JS456', 'email' => 'jane@example.com']);

        $response = $this->getJson('/api/employees/search?keyword=John');
        $response->assertStatus(200)->assertJsonCount(1);

        $response = $this->getJson('/api/employees/search?keyword=JS456');
        $response->assertStatus(200)->assertJsonCount(1);

        $response = $this->getJson('/api/employees/search?keyword=john@example.com');
        $response->assertStatus(200)->assertJsonCount(1); 

        

    }
}
