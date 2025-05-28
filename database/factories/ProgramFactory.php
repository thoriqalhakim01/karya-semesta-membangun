<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->name(),
            'description' => fake()->sentence(2),
            'target'      => fake()->numberBetween(1000000, 100000000),
            'created_at'  => fake()->dateTime(),
            'updated_at'  => fake()->dateTime(),
        ];
    }
}
