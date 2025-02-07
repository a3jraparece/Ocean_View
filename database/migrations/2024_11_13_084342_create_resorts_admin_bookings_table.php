<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortsAdminBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resorts_admin_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guestID');
            $table->unsignedBigInteger('resortID');
            $table->string('roomID');
            $table->string('payment_method');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('sub-total', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->string('status')->default('Partially Paid');
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
        Schema::dropIfExists('resorts_admin_bookings');
    }
}
