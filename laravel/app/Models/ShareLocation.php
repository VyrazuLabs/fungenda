<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareLocation extends Model
{
    protected $table = 'share_location';

    protected $fillable = [
    	'user_id',
        'given_name',
    	'shared_location_id',
    	'location_name',
    	'status',
    	'description',
        'country',
        'state',
    	'city',
        'city_name',
        'state_name',
    	'file'
    ];

    // Get City
    public function getCity() {
        return $this->hasOne('App\Models\City','id','city');
    }

    // Get State
    public function getState() {
        return $this->hasOne('App\Models\State','id','state');
    }
}
