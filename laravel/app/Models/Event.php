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
    						'event_location',
                            'event_venue',
    						'event_start_date',
    						'event_end_date',
                            'event_cost',
                            'event_lat',
                            'event_long',
                            'event_mobile',
                            'event_fb_link',
                            'event_twitter_link',
                            'event_website',
                            'event_email',
                            'event_status',
                            'event_start_time',
                            'event_end_time',
    						'event_active_days',
    						'event_image',
                            'event_main_image',
                            'event_description',
    						'created_by',
    						'updated_by',
                            'tag_id'
    					  ];

    // Get Category details
    public function getCategory() {
        return $this->hasOne('App\Models\Category','category_id','category_id');
    }
    // Get address details
    public function getAddress() {
        return $this->hasOne('App\Models\Address','address_id','event_location');
    }
    // Get event details
    public function getEventOffer(){
        return $this->hasOne('App\Models\EventOffer','event_id','event_id');
    }
    //Get favorite
    public function getFavorite(){
        return $this->hasMany('App\Models\MyFavorite','entity_id','event_id');        
    }
    // Get tag details
    public function getTags(){
        return $this->hasMany('App\Models\AssociateTag','entity_id','event_id');
    }
    // Get I am attending
    public function getWhoAreAttending(){
        return $this->hasMany('App\Models\IAmAttending','entity_id','event_id');
    }
}
