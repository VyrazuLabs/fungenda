<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_offer_id');
            $table->string('event_id');
            $table->string('discount_rate');
            $table->string('discount_types');
            $table->string('offer_description')->nullable();
            $table->string('event_wishlist_id')->nullable();
            $table->string('created_by');
            $table->integer('event_offer_status');
            $table->timestamps();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_offer');
    }
}
