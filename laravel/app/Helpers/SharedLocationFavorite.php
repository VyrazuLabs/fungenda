<?php

namespace app\Helpers;

use App\Models\SharedLocationMyFavorite;
use Auth;

class SharedLocationFavorite {
	public static function check($entity_id = 0) {
		//for loggedout user
		if(!Auth::check()) {
			return false;
		}

		$favourite = SharedLocationMyFavorite::where('shared_location_id', $entity_id)
						->where('user_id', Auth::user()->user_id)
						->first();
		
		if( count($favourite) > 0 && $favourite->status == 1 ) {
			return true;
		}
		else {
			return false;
		}
	}
}