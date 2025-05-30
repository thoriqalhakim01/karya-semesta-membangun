<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'birth_date'     => fake()->date(),
            'birth_place'    => fake()->city(),
            'gender'         => fake()->randomElement(['male', 'female']),
            'is_married'     => fake()->boolean(),
            'last_education' => fake()->randomElement(['SD', 'SMP', 'SMA', 'SMK', 'D3', 'S1', 'S2', 'S3']),
            'major'          => fake()->jobTitle(),
            'job'            => fake()->jobTitle(),
            'created_at'     => fake()->dateTime(),
            'updated_at'     => fake()->dateTime(),
        ];
    }
}
