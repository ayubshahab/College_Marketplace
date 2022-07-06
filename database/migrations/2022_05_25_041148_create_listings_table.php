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
        Schema::create('listings', function (Blueprint $table) {
            // create the listing id which is unsigned and unique
            $table->id('id')->unique();
        
            //create the user id which will serve as the foreign key
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // listing name
            $table->string('item_name');
            // listing price stands for 9999999.99
            $table->decimal('price',9,2);
            // listing negotiable
            $table->string('negotiable');
            // listing condition
            $table->string('condition');
            // listing category
            $table->string('category');
            // listing sub-categories/tags
            $table->string('tags');
            // listing description
            $table->longText('description');
            $table->longText('image_uploads')->nullable();


            // listing location
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->string('status')->nullable()->default('Available');

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            //listing created_on and updated_on
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
