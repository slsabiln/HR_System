<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
class EmployeeAllowanceFactory extends Factory
{
    protected $model = \App\Models\EmployeeAllowance::class;

    public function definition()
    {
        return [
       
        'allowance_type' => $this->faker->randomElement(['Housing', 'Transport', 'Food']),
        'amount' => $this->faker->numberBetween(100, 2000),
    ];
    }

    
}
