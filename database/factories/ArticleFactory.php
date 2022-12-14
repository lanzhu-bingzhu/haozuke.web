<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(100),
            'desc' => $this->faker->text(100),
            'author' => $this->faker->name,
            'pic' => '/upload/article/' . rand(1, 6) . '.jpg',
            'body' => $this->faker->text
        ];
    }
}
