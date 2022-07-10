<?php

namespace Database\Factories;

use App\Models\{Page, Post, User};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'   => User::factory(),
            'title'     => $this->faker->sentence(),
            'body'      => $this->faker->realText(1000),
            'summary'   => $this->faker->realText(),
        ];
    }

    public function image($imagePath)
    {
        return $this->afterCreating(function (Page $page) use ($imagePath) {
            $page->update([
                'image' => Storage::disk('public')->putFileAs('pages', $imagePath, "page-{$page->id}.jpeg"),
            ]);
        });
    }
}
