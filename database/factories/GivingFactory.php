<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Church;

class GivingFactory extends Factory
{
    public function definition(): array
{
    return [
        'church_id' => \App\Models\Church::inRandomOrder()->value('id'),
        'or_number'   => 'OR-' . strtoupper($this->faker->unique()->bothify('####??')),
        'giving_date' => $this->faker->dateTimeBetween('-30 days', 'now'),
        'type' => $this->faker->randomElement(\App\Models\Giving::TYPES),
        'amount'      => $this->faker->numberBetween(100, 5000),
        'notes'       => $this->faker->optional()->sentence(),
    ];
}
}