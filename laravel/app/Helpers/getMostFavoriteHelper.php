<?php

namespace app\Helpers;

use App\Models\MyFavorite;
use App\Models\Business;
use App\Models\Event;
class getMostFavoriteHelper{

	static function mostFavorite(){

		$data_business = Business::all();
		foreach ($data_business as $value) {
			$business_count = count($value->getFavorite()->get());
			$data_business2[$business_count] =  $value;
		}
		
		$data_event = Event::all();
		foreach ($data_event as $val) {
			$event_count = count($val->getFavorite()->get());
			$data_event2[$event_count] = $val;
		}

		foreach ($data_business2 as $key => $value) {
			$data_business1[$key] = $value;
			$data_business_final[0] = $data_business1;
		}

		foreach ($data_event2 as $key => $value) {
			$data_event1[$key] = $value;
			$data_event_final[0] = $data_event1;
		}

		$array_marged = array_merge($data_business_final,$data_event_final);
		foreach ($array_marged as $value) {
			foreach ($value as $key => $val) {
				$final_array[$key] = $val;
			}
		}

		krsort($final_array);
		foreach ($final_array as $key => $value) {
			$sorted_array[$key] = $value;
		}
		$count = 0;
		foreach ($sorted_array as $key => $value) {
			$new_array[$key] = $value;
			$count++;
			if($count == 3){
				break;
			}
		}

		// 	echo "<pre>";	
		// print_r($new_array);
		foreach ($new_array as $value) {
			if($value['business_image']){
				$value['image'] = explode(',', $value['business_image']);
			}
			if($value['event_image']){
				$value['image'] = explode(',', $value['event_image']);
			}
		}
		return $new_array;
	}
}