<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'thumbnail' => 'https://www.btaskee.com/wp-content/uploads/2020/11/home-cleaning-banner-ver-25.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
