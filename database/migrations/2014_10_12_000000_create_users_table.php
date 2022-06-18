<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
             // user primary id whic is unsigned and unique
            $table->id('id')->unique();
            // set it as the primary id
            // $table->primary('user_id');
            // user first name
            $table->string('first_name');
            // user last name
            $table->string('last_name');
            // user's username
            $table->string('username')->nullable();
            // user password
            $table->string('password');
            // user email
            $table->string('email')->unique();
            $table->string("avatar")->nullable()->default('https://via.placeholder.com/150');
            $table->string('watchlist')->nullable(); //will store keywords
            //will store favorites (their listing ids)
            $table->string('favorites')->nullable(); 
            // user phone number
            $table->string('number')->nullable();
            // listing location
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            //listing created_on and updated_on
            // timestamps of created_at and updated_at
            $table->timestamps();
            // remember token
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
