<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Post> */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(3),
            'isi' => fake()->paragraph(3),
            'gambar' => null,
            'publish_status' => 'published',
            'order_index' => fake()->numberBetween(1, 10),
        ];
    }
}