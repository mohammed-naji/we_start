<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rr = fake()->unique()->words(3, true);
        $name = json_encode([
            'en' => $rr,
            'ar' => fake()->words(3, true),
        ], JSON_UNESCAPED_UNICODE);

        return [
            'name' => $name,
            'slug' => Str::slug($rr),
            'parent_id' => rand(1, 10)
        ];
    }
}
