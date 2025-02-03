<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //

            'name'        => $this->faker->unique()->company,                     // Generate a unique company name as the community name
            'description' => $this->faker->paragraph,                             // Generate a random paragraph as the description
            'created_by'  => User::factory(),                                     // Create a user or use an existing one
            'status'      => $this->faker->randomElement(['active', 'archived']), // Randomly assign status
        ];
    }
}
