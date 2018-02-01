<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_id');
            $table->string('category_id');
            $table->string('business_title');
            $table->string('business_location');
            $table->string('business_venue');
            $table->string('business_lat');
            $table->string('business_long');
            $table->string('business_active_days')->nullable();
            $table->longText('business_image')->nullable();
            $table->longText('business_description')->nullable();
            $table->integer('business_status');
            $table->string('business_cost')->nullable();
            $table->string('business_mobile')->nullable();
            $table->string('business_fb_link')->nullable();
            $table->string('business_twitter_link')->nullable();
            $table->string('business_website')->nullable();
            $table->string('business_email')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('business');
    }
}
