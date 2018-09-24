<?php

namespace app\Helpers;

use App\Models\RecentlyViewed;

class recentlyViewedHelper{

	static function recentlyViewed(){

		$modified_data = [];
		$data_final = [];
		$new_array = [];
		$business_count = '';
		$business_image = [];
		$business_title = '';
		$business_venue = '';
		$business_website = '';


		$event_count = '';
		$event_image = [];
		$event_title = '';
		$event_venue = '';
		$event_website = '';

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
			if($count == 5){
				break;
			}
		}
		// For gettnig all details from event and business table
		foreach ($new_array as $key => $value) {
			if($value['type'] == 1){
				$businessDetails = $value->getBusinessDetails()->first();
				if(!empty($businessDetails)) {
					$business_count = $businessDetails->getFavorite()->where('status',1)->get();
					$business_image =  explode(',', $businessDetails->business_image);
					$business_title = $businessDetails->business_title;
					$business_venue = $businessDetails->business_venue;
					$business_website = $businessDetails->business_website;
					// $business_count = count($value->getBusinessDetails()->first()->getFavorite()->where('status',1)->get());
				}
				$value['fav_count'] = $business_count;
				$value['image'] = $business_image;
				$value['name'] = $business_title;
				$value['location'] = $business_venue;
				$value['website'] = $business_website;
				
				// $value['image'] = explode(',', $value->getBusinessDetails()->first()->business_image);
				// $value['name'] = $value->getBusinessDetails()->first()->business_title;
				// $value['location'] = $value->getBusinessDetails()->first()->business_venue;
				// $value['website'] = $value->getBusinessDetails()->first()->business_website;

				$business_discount_rate = null;
				if(!empty($value->getBusinessOffer)) {
					$business_discount_rate = $value->getBusinessOffer->business_discount_rate;
				}
				$value['business_discount'] =  $business_discount_rate;

			}
			if($value['type'] == 2){
				// $event_count = count($value->getEventDetails()->first()->getFavorite()->where('status',1)->get());
				// $value['fav_count'] = $event_count;
				// $value['image'] = explode(',', $value->getEventDetails()->first()->event_image);
				// $value['name'] = $value->getEventDetails()->first()->event_title;
				// $value['location'] = $value->getEventDetails()->first()->event_venue;
				// $value['website'] = $value->getEventDetails()->first()->event_website;

				



	            $eventDetails = $value->getEventDetails()->first();
				if(!empty($eventDetails)) {
					$event_count = $eventDetails->getFavorite()->where('status',1)->get();
					$event_image =  explode(',', $eventDetails->event_image);
					$event_title = $eventDetails->event_title;
					$event_venue = $eventDetails->event_venue;
					$event_website = $eventDetails->event_website;
				}
				$value['fav_count'] = $event_count;
				$value['image'] = $business_count;
				$value['name'] = $event_title;
				$value['location'] = $event_venue;
				$value['website'] = $event_website;
				$event_discount_rate = null;
	            if(!empty($value->getEventOffer)) {
	                $event_discount_rate = $value->getEventOffer->discount_rate;
	            }
	            $value['event_discount'] =  $event_discount_rate;

			}
		}
		// echo "<pre>";
		// print_r($new_array);
		return $new_array;
	}	
}