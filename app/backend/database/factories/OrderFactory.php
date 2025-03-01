<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'order_number' => $this->faker->unique()->numerify('ORD-#############'),
            'total' => $this->faker->randomFloat(2, 10, 500), 
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
