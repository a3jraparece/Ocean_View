<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortsAdminRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resorts_admin_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('roomID');
            $table->unsignedBigInteger('resortID');
            $table->string('room_type')->nullable();
            $table->string('room_image')->nullable();
            $table->string('description')->nullable();
            $table->string('inclusions', 2000)->nullable();
            $table->integer('capacity')->nullable();
            $table->string('amenities', 2000)->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();
            // 
            $table->unique(['resortID', 'roomID']);
            $table->foreign('resortID')->references('resortID')->on('resorts_admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resorts_admin_rooms');
    }
}
