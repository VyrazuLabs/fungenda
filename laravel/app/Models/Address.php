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
}
