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
        Schema::create('yard_sales', function (Blueprint $table) {
            // id of the user
            $table->id()->unique();

            // the user id that created the yard sale post
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // yard sale title
            $table->string('yard_sale_title');

            // yard sale date
            $table->date('yard_sale_date');

            //yard sale start time
            $table->string('start_time');

            //yard sale end time
            $table->string('end_time');

            $table->string('category');
            //yard sale description
            $table->longText('description');

            //image uploads -> can upload up to 10 images
            $table->longText('image_uploads')->nullable();

            // address of the listing happening
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postcode');

            $table->string('location_notes')->nullable();
            //time stamp of crated and updated
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
        Schema::dropIfExists('yard_sales');
    }
};
