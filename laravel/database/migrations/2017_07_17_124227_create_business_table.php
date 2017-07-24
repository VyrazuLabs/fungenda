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
            $table->string('business_title')->nullable();
            $table->string('location')->nullable();
            $table->string('venue')->nullable();
            $table->dateTime('business_start_date')->nullable();
            $table->dateTime('business_end_date')->nullable();
            $table->dateTime('business_active_days')->nullable();
            $table->longText('business_image')->nullable();
            $table->integer('business_status')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('business');
    }
}
