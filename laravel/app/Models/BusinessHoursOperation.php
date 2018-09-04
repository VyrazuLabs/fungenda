<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessHoursOperation extends Model
{
    protected $table = 'business_hours_operation';
    protected $fillable = [
    	'business_id',
        'sunday_start',
        'sunday_end',
    	'monday_start',
        'monday_end',
        'tuesday_start',
        'tuesday_end',
        'wednesday_start',
        'wednesday_end',
        'thursday_start',
        'thursday_end',
        'friday_start',
        'friday_end',
        'saturday_start',
        'saturday_end',
    ];
}
