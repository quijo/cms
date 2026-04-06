<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Church;

class ChurchFactory extends Factory
{
    public function definition(): array
    {
       return [
    'name' => $this->faker->company . ' Church',
    'church_number' => $this->faker->unique()->numerify('CH-####'),
    'status' => $this->faker->randomElement(['active', 'inactive']),
    'start_date' => $this->faker->date(),
    'contact_address' => $this->faker->address(),
];
    }
}