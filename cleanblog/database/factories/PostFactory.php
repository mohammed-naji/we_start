<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->unique()->words(4, true);
        return [
            'title' => $title ,
            'slug' => Str::slug($title),
            'image' => fake()->imageUrl() ,
            'content' => fake()->sentences(5, true),
            // 'content' => fake()->paragraphs(5, true),
            // 'content' => fake()->text(300),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }
}
