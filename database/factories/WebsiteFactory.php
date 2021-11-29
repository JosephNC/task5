<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Remove protocol
        $url = preg_replace('(^https?://)', '', $this->faker->url());

        // Remove www
        $url = ltrim($url, 'www.');

        // Remove trailing slash
        $url = rtrim($url, '/');

        $url = explode('/', $url);

        $url = $url[0];

        return compact('url');
    }
}
