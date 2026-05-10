<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'status'      => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'total'       => $this->faker->randomFloat(2, 50, 2000),
            'notes'       => $this->faker->optional()->sentence(),
            'ordered_at'  => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn() => ['status' => 'completed']);
    }

    public function pending(): static
    {
        return $this->state(fn() => ['status' => 'pending']);
    }
}
