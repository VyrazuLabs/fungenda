<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
    						'address_id',
    						'user_id',
    						'city_id',
    						'state_id',
    						'country_id',
    						'address_1',
                            'address_2',
    						'pincode'
    					  ];

    // Get City details
    public function getCity() {
        return $this->hasOne('App\Models\City','id','city_id');
    }
    // Get State details
    public function getState() {
        return $this->hasOne('App\Models\State','id','state_id');
    }
}
