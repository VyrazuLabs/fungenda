<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailNotificationSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_notification_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('notification_enabled');
            $table->integer('notification_frequency');
            $table->longText('event_id');
            $table->longText('business_id');
            $table->date('sending_date');
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
        Schema::dropIfExists('email_notification_setting');
    }
}
