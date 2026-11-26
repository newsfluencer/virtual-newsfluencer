<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(5, true),
            'source_uri' => $this->faker->url(),
            'source_title' => $this->faker->company(),
            'image' => $this->faker->imageUrl(),
            'published_at' => $this->faker->date(),
        ];
    }
}
