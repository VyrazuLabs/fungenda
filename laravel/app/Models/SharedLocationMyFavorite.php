<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedLocationMyFavorite extends Model
{
    protected $table = 'shared_location_my_favorite';

    protected $fillable = [
    	'shared_location_id',
    	'user_id',
    	'status'
    ];
}
