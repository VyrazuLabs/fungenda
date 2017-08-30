<?php

namespace app\Helpers;

use App\Models\Category;
use Auth;

class ShowJoiningDate {
	
	//Getting joining date of admin 
	public static function getJoiningDate(){

		$time = Auth::user()->where('type',2)->first()->created_at;
		$timestamp = strtotime($time);
		$date = date('F j, Y', $timestamp);
		return $date;
	}
}