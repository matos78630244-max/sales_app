<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name'        => $this->faker->words(3, true),
            'sku'         => strtoupper($this->faker->unique()->bothify('SKU-####')),
            'description' => $this->faker->paragraph(),
            'price'       => $this->faker->randomFloat(2, 10, 500),
            'stock'       => $this->faker->numberBetween(0, 100),
            'active'      => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn() => ['active' => false, 'stock' => 0]);
    }
}
