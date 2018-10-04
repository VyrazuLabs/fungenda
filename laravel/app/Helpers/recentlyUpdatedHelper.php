<?php

namespace app\Helpers;

use App\Models\Business;
use App\Models\Event;
use Illuminate\Support\Arr;

class recentlyUpdatedHelper{

	static function recentlyUpdated(){

		$modified_all_business = [];
		$modified_all_event = [];
		$data_business1 = [];
		$data_event1 = [];
		$data_business_final = [];
		$data_event_final = [];
		$sorted_array = [];
		$new_array = [];
		$final_array = [];

		$all_business = Business::all();
		foreach ($all_business as $value) {

			$business_discount_rate = null;
            if(!empty($value->getBusinessOffer)) {
                $business_discount_rate = $value->getBusinessOffer->business_discount_rate;
            }
            $value['business_discount'] =  $business_discount_rate;

			$business_count = count($value->getFavorite()->where('status',1)->get());
			$value['fav_count'] =  $business_count;
			$updated_timestamp = strtotime($value['updated_at']);
			$modified_all_business[$updated_timestamp] = $value;
		}

		$all_event = Event::all();
		foreach ($all_event as $value) {

			$event_discount_rate = null;
            if(!empty($value->getEventOffer)) {
                $event_discount_rate = $value->getEventOffer->discount_rate;
            }
            $value['event_discount'] =  $event_discount_rate;

			$event_count = count($value->getFavorite()->where('status',1)->get());
			$value['fav_count'] = $event_count;
			$updated_timestamp = strtotime($value['updated_at']);
			$modified_all_event[$updated_timestamp] = $value;
		}

		foreach ($modified_all_business as $key => $value) {
			$data_business1[$key] = $value;
			$data_business_final[0] = $data_business1;
		}

		foreach ($modified_all_event as $key => $value) {
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
			if($count == 5){
				break;
			}
		}

		foreach ($new_array as $value) {
			if($value['business_image']){
				$value['image'] = explode(',', $value['business_image']);
				 if (!empty( $value['business_main_image'])){
					$value['image'] = Arr::prepend($value['image'], $value['business_main_image']);
				}
			}
			if($value['event_image']){
				$value['image'] = explode(',', $value['event_image']);
				 if (!empty($value['event_main_image'])){
				 	$value['image'] = Arr::prepend($value['image'], $value['event_main_image']);
				 }				
			}
		}
		// echo "<pre>";
		// print_r($new_array);die;
		return $new_array;
	}
}