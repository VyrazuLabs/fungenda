<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyFavorite extends Model
{
    protected $table = 'my_favourites';

    protected $fillable = [
    	'entity_id',
    	'user_id',
    	'entity_type',
    	'status',
    ];

     /* Get favourite details of events */
    public function getEvents() {
        return $this->hasMany('App\Models\Event','event_id','entity_id');
    }
    /* Get favourite details business */
    public function getBusiness() {
        return $this->hasMany('App\Models\Business','business_id','entity_id');
    }
}
