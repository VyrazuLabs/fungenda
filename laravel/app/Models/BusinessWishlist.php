<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessWishlist extends Model
{
    protected $table = 'business_wishlist';

    protected $fillable = [
    	'business_wishlist_id',
    	'user_id',
    	'business_id',
    	'business_wishlist_status',
    ];
}
