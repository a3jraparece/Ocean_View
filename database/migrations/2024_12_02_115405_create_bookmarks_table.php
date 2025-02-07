<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     Schema::create('bookmarks', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }
    Schema::create('guest_bookmarks', function (Blueprint $table) {
        $table->id(); 
        $table->unsignedBigInteger('guestID'); 
        $table->unsignedBigInteger('resortID'); 
        $table->timestamps(); 

        $table->foreign('guestID')->references('guestID')->on('guests')->onDelete('cascade');
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
        Schema::dropIfExists('bookmarks');
    }
}
