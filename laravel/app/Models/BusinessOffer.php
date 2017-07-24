<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessOffer extends Model
{
    protected $table = 'business_offer';
    protected $fillable = [
    						'business_offer_id',
    						'business_id',
    						'offer_description',
    						'business_wishlist_id',
    						'created_by',
    						'business_offer_status',
    						'updated_by'
    					  ];
}
