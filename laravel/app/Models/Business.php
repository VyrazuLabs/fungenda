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
    						'business_location',
                            'business_venue',
                            'business_lat',
                            'business_long',
                            'business_cost',
                            'business_mobile',
                            'business_fb_link',
                            'business_twitter_link',
                            'business_website',
                            'business_email',
    						'business_image',
    						'business_status',
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
    //Get business offer
    public function getBusinessOffer(){
        return $this->hasOne('App\Models\BusinessOffer','business_id','business_id');
    }
}
