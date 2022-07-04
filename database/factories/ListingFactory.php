<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use NunoMaduro\Collision\Adapters\Phpunit\State;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
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
        $rentalCondition = array('New' , 'Good', 'Slightly Used', 'Used Normal Wear');
        $rentalStatus = array('Rented', 'Available');
        $rentalCategory = array('Furniture', 'Clothes', 'Electronics', 'Kitchen', 'School Accessories');
        $negotiable =array('Fixed', 'Negotiable' , 'Free');
        return [
            'user_id'=> random_int(1,10),
            'item_name' => $this->faker->text(random_int(5,100)),
            'price' => random_int(50,500),
            'negotiableFree'=>$negotiable[array_rand($negotiable)],
            'condition' => $rentalCondition[array_rand($rentalCondition)],
            'category' => $rentalCategory[array_rand($rentalCategory)],
            'tags' => strval($commaSeperatedString) ,
            'description' => $this->faker->paragraph(5),
            'image_uploads'=>null,
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
