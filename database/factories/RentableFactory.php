<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RentableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //create an array of random words
        $randomTagsArray = $this->faker->words($nbWords = 6, $asText = false);
        $commaSeperatedString = implode(", ", $randomTagsArray);

        // rental type array
        $rentalType = array('Hourly', 'Daily', 'Weekly', 'Monthly');
        $rentalCondition = array('New' , 'Good', 'Slightly Used', 'Used Normal Wear');
        $rentalStatus = array('Rented', 'Available');
        $rentalCategory = array('Furniture', 'Clothes', 'Electronics', 'Kitchen', 'School Accessories', "Books");
        $rentableNegotiable = array('Fixed', 'Negotiable');
        return [
            // ownership
            'user_id'=> random_int(1,10),


            'rental_title' => $this->faker->text(random_int(5,100)),
            'rental_duration' => $rentalType[array_rand($rentalType)],
            'rental_charging' => random_int(50,500),
            'negotiable' => $rentableNegotiable[array_rand($rentableNegotiable)],
            'condition' => $rentalCondition[array_rand($rentalCondition)],
            'category' => $rentalCategory[array_rand($rentalCategory)],
            'tags' => strval($commaSeperatedString) ,
            'description' => $this->faker->paragraph(5),
            'image_uploads'=>null,
            'status' => $rentalStatus[array_rand($rentalStatus)],

            // rental location
            'street' => $this->faker->streetAddress(),
            'city' =>$this->faker->city(),
            'state'=>$this->faker->state(),
            'country'=>$this->faker->country(),
            'postcode'=>$this->faker->postcode(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
