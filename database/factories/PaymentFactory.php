<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'method'   => $this->faker->randomElement(['cash', 'card', 'transfer']),
            'amount'   => $this->faker->randomFloat(2, 50, 2000),
            'status'   => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'paid_at'  => $this->faker->optional()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
