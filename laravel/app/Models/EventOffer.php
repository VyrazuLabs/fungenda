<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOffer extends Model
{
    protected $table = 'event_offer';
    protected $fillable = [
    						'event_offer_id',
    						'event_id',
    						'offer_description',
    						'event_wishlist_id',
    						'created_by',
    						'event_offer_status',
    						'updated_by'
    					  ];
}
