<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareLocation extends Model
{
    protected $table = 'share_location';

    protected $fillable = [
    	'user_id',
    	'shared_location_id',
    	'location_name',
    	'status',
    	'description',
        'country',
        'state',
    	'city',
    	'file'
    ];
}
