<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
    	'user_id',
    	'user_image',
    	'user_phone_number',
    	'user_address',
    	'updated_by'
    ];
}
