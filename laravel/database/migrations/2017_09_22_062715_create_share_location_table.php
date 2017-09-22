<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('location_name');
            $table->integer('status');
            $table->longText('description')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('file')->nullable();
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
