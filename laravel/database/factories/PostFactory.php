<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'slug' => Str::slug($this->faker->word() . rand(100, 999)),
            'description' => $this->faker->paragraph(),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
        ];
    }
}
