<?php

namespace app\Helpers;

use App\Models\MyFavorite;
use Auth;

class Favourite {
	public static function check($entity_id = 0, $entity_type = 0) {
		//for loggedout user
		if(!Auth::check()) {
			return false;
		}

		$favourite = MyFavorite::where('entity_id', $entity_id)
						->where('user_id', Auth::user()->user_id)
						->where('entity_type', $entity_type)
						->first();
		
		if( count($favourite) > 0 && $favourite->status == 1 ) {
			return true;
		}
		else {
			return false;
		}
	}
}