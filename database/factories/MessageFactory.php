<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        do{
            $from = rand(1,10);
            $to = rand(1,10);
            $listing_id = rand(1,20);
            $rental_id = rand(1,20);
            $is_read = rand(0,1);
        }while($from === $to);
        return [
            'from' => $from,
            'to' => $to,
            'for_listing' => $listing_id,
            'for_rentals' => $rental_id,
            'message' => $this->faker->sentence(),
            'is_read' => $is_read
        ];
    }
}
