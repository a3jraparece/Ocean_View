<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResortsAdminEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resorts_admin_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resortID');
            $table->text('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            
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
        Schema::dropIfExists('resorts_admin_events');
    }
}
