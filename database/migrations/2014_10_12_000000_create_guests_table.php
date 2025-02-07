<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id('guestID');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('f_name');
            $table->string('m_name');
            $table->string('l_name');
            $table->bigInteger('phone_number')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('location');
            $table->string('prof_pic')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->nullable();
            $table->decimal('balance', 8, 2)->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('guests');
    }
}
