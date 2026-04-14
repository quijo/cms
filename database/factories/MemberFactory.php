<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;
use App\Models\Church;
use App\Models\User;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        $sex = $this->faker->randomElement(['male', 'female']);

        return [
            'name' => $this->faker->name($sex),
            'church_id' => Church::inRandomOrder()->first()?->id ?? Church::factory()->create()->id,
            'user_id' => User::inRandomOrder()->first()?->id ?? null,
            'email' => $this->faker->unique()->safeEmail(),
            'contact_number' => $this->faker->phoneNumber(),
            'age' => $this->faker->numberBetween(18, 80),
            'sex' => $sex,
            'membership_date' => $this->faker->date(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}