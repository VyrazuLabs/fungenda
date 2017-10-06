<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = [
    	'facebook',
    	'twitter',
    	'linkedin',
    	'google_plus',
    	'pinterest',
    	'mail_id'
    ];
}
