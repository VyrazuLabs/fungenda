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
            $table->string('location');
            $table->dateTime('business_start_date');
            $table->dateTime('business_end_date');
            $table->dateTime('business_active_days');
            $table->longText('business_image');
            $table->integer('business_status');
            $table->string('created_by');
            $table->timestamps();
            $table->string('updated_by',45);
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
