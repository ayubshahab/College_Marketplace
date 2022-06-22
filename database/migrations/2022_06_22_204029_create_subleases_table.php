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
        Schema::create('subleases', function (Blueprint $table) {
            $table->id('id')->unique();
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //sublease attributes
            $table->string('sublease_title');
            $table->string('location');
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->decimal('rent', 9, 2);
            $table->string('negotiable');
            $table->string('condition');
            $table->string('utilities');
            $table->longText('description');
            $table->longText('image_uploads')->nullable();

            // sublease location
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postcode');
            $table->string('status')->nullable()->default('Available');

            //updated and created at
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
        Schema::dropIfExists('subleases');
    }
};
