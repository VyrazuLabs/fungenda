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
            $table->string('event_title')->nullable();
            $table->string('location')->nullable();
            $table->string('venue')->nullable();
            $table->dateTime('event_start_date')->nullable();
            $table->dateTime('event_end_date')->nullable();
            $table->string('event_active_days')->nullable();
            $table->longText('event_image')->nullable();
            $table->integer('event_status')->nullable();
            $table->string('created_by')->nullable();
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
