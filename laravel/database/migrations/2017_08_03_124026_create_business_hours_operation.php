<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessHoursOperation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hours_operation', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('business_id');
            $table->string('sunday_start')->nullable();
            $table->string('sunday_end')->nullable();
            $table->string('monday_start')->nullable();
            $table->string('monday_end')->nullable();
            $table->string('tuesday_start')->nullable();
            $table->string('tuesday_end')->nullable();
            $table->string('wednesday_start')->nullable();
            $table->string('wednesday_end')->nullable();
            $table->string('thursday_start')->nullable();
            $table->string('thursday_end')->nullable();
            $table->string('friday_start')->nullable();
            $table->string('friday_end')->nullable();
            $table->string('saturday_start')->nullable();
            $table->string('saturday_end')->nullable();
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
        Schema::dropIfExists('business_hours_operation');
    }
}
