<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('reviewID');
            $table->unsignedBigInteger('guestID')->nullable();
            $table->unsignedBigInteger('resortID')->nullable();
            $table->unsignedTinyInteger('rating')->comment('Rating from 1 to 5')->nullable();
            $table->text('comment')->nullable();
            $table->date('reviewDate')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();

            // Foreign key constraints
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
        Schema::dropIfExists('reviews');
    }
}
