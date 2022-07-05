<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use App\Models\Message;
use App\Models\Rentable;
use App\Models\Sublease;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // will create 10 random users and insert them into the db
        User::factory(10)->create();
        Listing::factory(30)->create();
        Rentable::factory(30)->create();
        Sublease::factory(8)->create();
        // Message::factory(10000)->create();

        // $user = User::factory()->create(
        //     [
        //         'first_name'=>'John',
        //         'last_name'=>'Doe',
        //         'email'=>'john.doe@gmail.com'
        //     ]
        // );
        
        // Listing::factory(50)->create([
        //     'user_id'=> $user ->id
        // ]);

        // Listing::create(
        //     [
        //         'user_id'=> 1,
        //         'item_name' => 'Used Tablet',
        //         'price' => 125.23,
        //         'negotiable' => true,
        //         'condition' => 'slightly used',
        //         'category' => 'electronics',
        //         'tags' => 'tablet, electronics, samsung',
        //         'location' => '14897 Cherrydale Dr, Woodbridge VA, 22193',
        //         'description' => 'Lightly used tablet, almost looks like new',
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]
        // );
        
        // Listing::create(
        //     [
        //         'user_id'=> 5,
        //         'item_name' => 'Used Sofa',
        //         'price' => 200,
        //         'negotiable' => true,
        //         'condition' => 'used',
        //         'category' => 'furniture',
        //         'tags' => 'couch, sofa, recliner',
        //         'location' => '14897 Cherrydale Dr, Woodbridge VA, 22193',
        //         'description' => 'Lightly used couch',
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]
        // );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
