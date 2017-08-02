<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_offer_id');
            $table->string('business_id');
            $table->string('offer_description')->nullable();
            $table->string('business_wishlist_id')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('business_offer_status')->nullable();
            $table->timestamps();
            $table->string('updated_by',45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_offer');
    }
}
