<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
    						'event_id',
    						'category_id',
    						'event_title',
    						'location',
                            'venue',
    						'event_start_date',
    						'event_end_date',
                            'event_start_time',
                            'event_end_time',
    						'event_active_days',
    						'event_image',
    						'event_status',
    						'created_by',
    						'updated_by'
    					  ];

    // Get Category details
    public function getCategory() {
        return $this->hasOne('App\Models\Category','category_id','category_id');
    }
    // Get address details
    public function getAddress() {
        return $this->hasOne('App\Models\Address','address_id','location');
    }
}
