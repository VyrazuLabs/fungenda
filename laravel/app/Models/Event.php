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
    						'event_active_days',
    						'event_image',
    						'event_status',
    						'created_by',
    						'updated_by'
    					  ];

    public function getAddress(){
        return $this->hasOne('App\Models\Address', 'address_id', 'location');
    }
}
