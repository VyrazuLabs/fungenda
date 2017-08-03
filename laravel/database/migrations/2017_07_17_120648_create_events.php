<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_id');
            $table->string('category_id');
            $table->string('event_title');
            $table->string('event_location');
            $table->string('event_venue');
            $table->dateTime('event_start_date');
            $table->dateTime('event_end_date');
            $table->string('event_start_time')->nullable();
            $table->string('event_end_time')->nullable();
            $table->string('event_active_days')->nullable();
            $table->longText('event_image')->nullable();
            $table->integer('event_status');
            $table->string('event_cost');
            $table->string('event_lat');
            $table->string('event_long');
            $table->integer('event_mobile');
            $table->string('event_fb_link')->nullable();
            $table->string('event_twitter_link')->nullable();
            $table->string('event_website')->nullable();
            $table->string('event_email')->nullable();
            $table->string('created_by');
            $table->timestamps();
            $table->string('updated_by')->nullable();
            $table->string('tag_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
