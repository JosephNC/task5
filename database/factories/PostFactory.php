<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Website;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Website ids
        $website_ids = Website::pluck('id')->toArray();

        shuffle($website_ids);

        return [
            'title'         => $this->faker->sentence(rand(2, 5), false),
            'description'   => $this->faker->paragraph(),
            'website_id'    => $website_ids[0],
        ];
    }
}
