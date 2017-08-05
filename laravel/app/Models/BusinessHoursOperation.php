<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessHoursOperation extends Model
{
    protected $table = 'business_hours_operation';
    protected $fillable = [
    	'business_id',
    	'sunday',
    	'monday',
    	'tuesday',
    	'wednesday',
    	'thursday',
    	'friday',
    	'saturday'
    ];
}
