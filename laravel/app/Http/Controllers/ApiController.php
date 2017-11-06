<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class ApiController extends Controller
{
    public function getEventData(){
    	$all_events = Event::paginate(4);

    	foreach ($all_events as $event) {
    		$img = explode(',',$event['event_image']);
    		$city_name = $event->getAddress()->first()->getCity()->first()->name;
    		$state_name = $event->getAddress()->first()->getState()->first()->name;
    		$event['image'] = $img;
    		$event['city_name'] = $city_name;
    		$event['state_name'] = $state_name;
    	}

        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }
            
    	return view('frontend.pages.viewevents',compact('all_events','all_category'));
    }
}
