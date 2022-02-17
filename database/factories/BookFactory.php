<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Genre;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numerify('##########'),
            'name' => $this->faker->name(),
            'author_id' => Author::inRandomOrder()->get()->first()->id,
            'genre_id' => Genre::inRandomOrder()->get()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
