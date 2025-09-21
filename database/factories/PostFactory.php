<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'id_category' => Category::factory(),
            'title' => $this->faker->unique()->sentence(4),
            'body' => $this->faker->paragraphs(3, true),
            'author' => $this->faker->name(),
            'image' => 'homolog/test-image.jpg',
            'qt_views' => 0,
            'qt_emails' => 0,
        ];
    }
}