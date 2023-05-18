<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_code'   => '',
            'image'          => 'no-image.png',
            'name'           => $this->faker->name(),
            'category_id'    => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'weight'         => $this->faker->numberBetween(50, 250),
            'stock'          => $this->faker->numberBetween(10, 80),
            'capital_price'  => $this->faker->numberBetween(65000, 135000),
            'selling_price'  => $this->faker->numberBetween(135000, 270000),
            'description'    => $this->faker->paragraph(),
            'min_stock'      => 0,
            'status_variant' => 0
        ];
    }
}
