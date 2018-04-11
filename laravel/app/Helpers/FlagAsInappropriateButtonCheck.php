<?php

namespace app\Helpers;

use App\Models\FlagAsInAppropriate;
use Auth;

class FlagAsInappropriateButtonCheck{

	//Get tag name
	static function FlagAsInappropriateButtonCheck($entity_id = 0,$entity_type = 0){

		if(Auth::check()){
			$data = FlagAsInAppropriate::where('user_id',Auth::user()->user_id)->where('entity_id',$entity_id)->where('entity_type',$entity_type)->where('status',1)->first();

			if(!empty($data)){
				return false;
			}
			else{
				return true;
			}
		}
	}
}