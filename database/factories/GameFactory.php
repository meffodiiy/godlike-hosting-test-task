<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = ['Action', 'Adventure', 'RPG', 'Strategy', 'Simulation', 'Sports', 'Puzzle', 'FPS', 'MMO'];
        $platforms = ['PC', 'PlayStation 5', 'PlayStation 4', 'Xbox Series X', 'Xbox One', 'Nintendo Switch', 'Mobile'];
        
        return [
            'title' => fake()->words(3, true) . ' ' . fake()->randomNumber(1, true),
            'developer' => fake()->company(),
            'genre' => fake()->randomElement($genres),
            'release_date' => fake()->dateTimeBetween('-5 years', '+1 year'),
            'platform' => fake()->randomElement($platforms),
            'price' => fake()->randomFloat(2, 9.99, 59.99),
            'cover_image' => null, // No real image for testing
        ];
    }
}
