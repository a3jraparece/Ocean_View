<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortsAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resorts_admin', function (Blueprint $table) {
            $table->id('resortID');
            $table->string('resort_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('location');
            $table->text('location_coordinates');
            $table->integer('floorCount');
            $table->integer('roomPerFloor');
            $table->decimal('taxRate', 5, 2);
            $table->decimal('room_rate', 10, 2);
            $table->string('status');
            $table->text('contactDetails')->nullable();
            $table->text('mainImage')->nullable();
            $table->text('image1')->nullable();
            $table->text('image1_2')->nullable();
            $table->text('image1_3')->nullable();
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->text('resort_description')->nullable();
            $table->text('amenities')->nullable();
            $table->text('room_image_1')->nullable();
            $table->text('room_image_2')->nullable();
            $table->text('room_image_3')->nullable();
            $table->text('room_description')->nullable();
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
        Schema::dropIfExists('resorts_admin');
    }
}
