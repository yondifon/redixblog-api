<?php

namespace Database\Factories;

use App\Models\{Post, User};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\{File, Storage};

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
        return [
            'user_id' => User::factory(),
            'title'   => $this->faker->sentence(),
            'body'    => $this->faker->realText(rand(300, 500)),
            'views'   => $this->faker->randomDigitNotNull(),
        ];
    }

    public function image($imagePath)
    {
        return $this->afterCreating(function (Post $post) use ($imagePath) {
            $post->update([
                'image' => Storage::disk('public')->putFileAs('posts', $imagePath, "posts-{$post->id}.jpeg"),
            ]);
        });
    }
}
