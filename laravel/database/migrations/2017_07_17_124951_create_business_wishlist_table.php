<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_wishlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_wishlist_id');
            $table->string('user_id');
            $table->string('business_id');
            $table->integer('business_wishlist_status');
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
        Schema::dropIfExists('business_wishlist');
    }
}
