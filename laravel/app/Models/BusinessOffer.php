<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessOffer extends Model
{
    protected $table = 'business_offer';
    protected $fillable = [
    						'business_offer_id',
    						'business_id',
    						'business_offer_description',
                            'business_discount_rate',
                            'business_discount_types',
    						'business_wishlist_id',
    						'created_by',
    						'business_offer_status',
    						'updated_by'
    					  ];
}
