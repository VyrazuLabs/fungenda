<?php

namespace app\Helpers;

use App\Models\RecentlyViewed;

class recentlyViewedHelper{

	static function recentlyViewed(){

		$modified_data = [];
		$data_final = [];
		$new_array = [];

		$data = RecentlyViewed::all();
		foreach ($data as $value) {
			$updated_timestamp = strtotime($value['created_at']);
			$modified_data[$updated_timestamp] = $value; 
		}
		krsort($modified_data);
		foreach ($modified_data as $key => $value) {
			$data_final[$key] = $value;
		}

		$count = 0;
		foreach ($data_final as $key => $value) {
			$new_array[$key] = $value;
			$count++;
			if($count == 3){
				break;
			}
		}
		// For gettnig all details from event and business table
		foreach ($new_array as $key => $value) {
			if($value['type'] == 1){
			   $business_count = count($value->getBusinessDetails()->first()->getFavorite()->where('status',1)->get());
			   $value['fav_count'] = $business_count;
			   $value['image'] = explode(',', $value->getBusinessDetails()->first()->business_image);
			   $value['name'] = $value->getBusinessDetails()->first()->business_title;
			   $value['location'] = $value->getBusinessDetails()->first()->business_venue;
			   $value['website'] = $value->getBusinessDetails()->first()->business_website;
			}
			if($value['type'] == 2){
				$event_count = count($value->getEventDetails()->first()->getFavorite()->where('status',1)->get());
				$value['fav_count'] = $event_count;
				$value['image'] = explode(',', $value->getEventDetails()->first()->event_image);
				$value['name'] = $value->getEventDetails()->first()->event_title;
				$value['location'] = $value->getEventDetails()->first()->event_venue;
				$value['website'] = $value->getEventDetails()->first()->event_website;
			}
		}
		// echo "<pre>";
		// print_r($new_array);
		return $new_array;
	}	
}