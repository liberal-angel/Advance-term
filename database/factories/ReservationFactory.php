<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'shop_id' => $this->faker->numberBetween(1, 20),
            'num_of_users' => $this->faker->numberBetween(1, 10)
        ];
    }
}
