<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';
    protected $fillable = [
    						'business_id',
    						'category_id',
    						'business_title',
    						'location',
                            'venue',
    						'business_start_date',
    						'business_end_date',
    						'business_active_days',
    						'business_image',
    						'business_status',
    						'created_by',
    						'updated_by'
    					  ];

    public function getAddress(){
        return $this->hasOne('App\Models\Address', 'address_id', 'location');
    }
}
