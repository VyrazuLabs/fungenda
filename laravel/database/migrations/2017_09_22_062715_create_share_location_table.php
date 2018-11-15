<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('shared_location_id');
            $table->string('given_name');
            $table->string('location_name');
            $table->integer('status');
            $table->longText('description')->nullable();
            $table->string('city')->nullable();
            $table->string('state');
            $table->string('country');
            $table->string('state_name');
            $table->string('city_name');
            $table->longText('file')->nullable();
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
        Schema::dropIfExists('share_location');
    }
}
