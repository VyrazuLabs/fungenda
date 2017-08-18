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
}
