<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IAmAttending extends Model
{
    protected $table = 'i_am_attending';

    protected $fillable = [
    	'user_id',
    	'entity_id',
    	'entity_type',
    	'status'
    ];

    // Get address details
    public function getUser() {
        return $this->hasOne('App\Models\User','user_id','user_id');
    }
}
