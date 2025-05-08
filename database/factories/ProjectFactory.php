<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
        ];
    }

    public function owner(int $owner_id): static
    {
        return $this->state(fn (array $attributes) => [
            'owner_id' => $owner_id,
        ]);
    }
}
