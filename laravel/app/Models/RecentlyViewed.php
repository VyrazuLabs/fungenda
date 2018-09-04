<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    protected $table = 'recently_viewed';

    protected $fillable = [
    	'entity_id',
    	'type',
    ];

    // Getting event details
    public function getEventDetails(){
    	return $this->hasOne('App\Models\Event','event_id','entity_id');
    }
    // Getting business details
    public function getBusinessDetails(){
    	return $this->hasOne('App\Models\Business','business_id','entity_id');
    }

    //Get business offer
    public function getBusinessOffer()
    {
        return $this->hasOne('App\Models\BusinessOffer', 'business_id', 'entity_id');
    }

    // Get event details
    public function getEventOffer(){
        return $this->hasOne('App\Models\EventOffer','event_id','entity_id');
    }
}
