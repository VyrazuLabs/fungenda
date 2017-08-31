<?php

namespace app\Helpers;

use App\Models\IAmAttending;
use Auth;

class IAmAttendingButtonCheck{

	//Get tag name
	static function IAmAttendingButtonCheck($entity_id,$entity_type){

		$data = IAmAttending::where('user_id',Auth::user()->user_id)->where('entity_id',$entity_id)->where('entity_type',$entity_type)->where('status',1)->first();

		if(!empty($data)){
			return false;
		}
		else{
			return true;
		}
	}
}