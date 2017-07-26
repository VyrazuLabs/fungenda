<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Business;
use App\Models\EventOffer;
use App\Models\BusinessOffer;
use App\Models\Address;

class frontendController extends Controller
{
	// return index page
    public function index(){
    	$all_events = Event::paginate(4);
    	foreach ($all_events as $event) {
    		$img = explode(',',$event['event_image']);
    		$event['image'] = $img;
    	}
    	$all_business = Business::paginate(4);
    	foreach ($all_business as $business) {
    		$img = explode(',',$business['business_image']);
    		$business['image'] = $img;
    	}
    	return view('frontend.pages.index',compact('all_events','all_business'));
    }
}
