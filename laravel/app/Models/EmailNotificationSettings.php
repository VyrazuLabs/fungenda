<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotificationSettings extends Model
{
   	protected $table = 'email_notification_setting';

   	protected $fillable = [
   		'user_id',
   		'notification_enabled',
   		'notification_frequency'
   	];
}
