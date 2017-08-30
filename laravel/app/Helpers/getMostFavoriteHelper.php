<?php

namespace app\Helpers;

use App\Models\MyFavorite;
use App\Models\Business;
use App\Models\Event;
class getMostFavoriteHelper{

	static function mostFavorite(){

		//define the required variables
		$data_business2 = [];
		$data_event2 = [];
		$data_business_final = [];
		$data_event_final = [];
		$final_array = [];
		$sorted_array = [];
		$new_array = [];

		//get data of all businesses
		$data_business = Business::all();
		foreach ($data_business as $value) {
			$business_count = count($value->getFavorite()->where('status',1)->get());
			$data_business2[$business_count] =  $value;
		}
		
		//get data of all events
		$data_event = Event::all();
		foreach ($data_event as $val) {
			$event_count = count($val->getFavorite()->where('status',1)->get());
			$data_event2[$event_count] = $val;
		}

		//modified businesses data
		foreach ($data_business2 as $key => $value) {
			$data_business1[$key] = $value;
			$data_business_final[0] = $data_business1;
		}

		//modified events data
		foreach ($data_event2 as $key => $value) {
			$data_event1[$key] = $value;
			$data_event_final[0] = $data_event1;
		}

		//marged events and businesses
		$array_marged = array_merge($data_business_final,$data_event_final);
		foreach ($array_marged as $value) {
			foreach ($value as $key => $val) {
				$final_array[$key] = $val;
			}
		}

		//short the marged array where favorite count is greater than zero
		krsort($final_array);
		foreach ($final_array as $key => $value) {
			if($key > 0){
				$sorted_array[$key] = $value;
			}
		}

		//get first three data from shorted array
		$count = 0;
		foreach ($sorted_array as $key => $value) {
			$new_array[$key] = $value;
			$count++;
			if($count == 3){
				break;
			}
		}

		//insert entity images in the new array
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