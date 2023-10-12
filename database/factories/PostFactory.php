<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        
            'user_id'=>factory(User::class),
            'title' =>$this->faker->sentence,
            'post_image' =>$this->faker->imageUrl(900,300),
            'body'=>$this->faker->paragraph
        ];
    }
}
