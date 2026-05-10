<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::all()->each(function ($order) {
            Payment::create([
                'order_id' => $order->id,
                'method'   => fake()->randomElement(['cash', 'card', 'transfer']),
                'amount'   => $order->total,
                'status'   => 'completed',
                'paid_at'  => now(),
            ]);
        });
    }
}
