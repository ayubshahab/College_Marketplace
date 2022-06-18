<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        return [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => null,
            'password' => '$2y$10$cmktUJeB21VwcrKQowuPG.H0.XlTK/vVb32D/.FE3of4drXHedP7.', // password
            'email' => $first_name . "." . $last_name . "@example.com",
            'avatar' => 'https://via.placeholder.com/150',
            'number' => $this->faker->phoneNumber(),
            'street' => $this->faker->streetAddress(),
            'city' =>$this->faker->city(),
            'state'=>$this->faker->state(),
            'country'=>$this->faker->country(),
            'postcode'=>$this->faker->postcode(),
            'created_at' => now(),
            'updated_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
