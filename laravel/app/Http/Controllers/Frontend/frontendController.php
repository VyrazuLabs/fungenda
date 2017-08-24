<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Business;
use App\Models\EventOffer;
use App\Models\BusinessOffer;
use App\Models\Address;
use App\Models\Category;
use App\Models\MyFavorite;
use Auth;

class frontendController extends Controller
{
	// return index page
    public function index(){
    	$all_events = Event::paginate(4);
    	foreach ($all_events as $event) {
            $event_count = count($event->getFavorite()->where('status',1)->get());
            $event['fav_count'] = $event_count;
    		$img = explode(',',$event['event_image']);
    		$event['image'] = $img;
            $related_tags = $event->getTags()->where('entity_type',2)->get();
            $event['tags'] = $related_tags;
    	}
    	$all_business = Business::paginate(4);
    	foreach ($all_business as $business) {
            $business_count = count($business->getFavorite()->where('status',1)->get());
            $business['fav_count'] = $business_count;
    		$img = explode(',',$business['business_image']);
    		$business['image'] = $img;
            $related_tags = $business->getTags()->where('entity_type',1)->get();
            $business['tags'] = $related_tags;
    	}
        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
            }

        return view('frontend.pages.index',compact('all_events','all_business','all_category'));
    }

    // return category page
    public function getCategory(Request $request){
        $input = $request->input();

        $all_events = Event::where('category_id',$input['q'])->paginate(4);
        foreach ($all_events as $event) {
            $event_count = count($event->getFavorite()->where('status',1)->get());
            $event['fav_count'] = $event_count;
            $event['event_image'] = explode(',', $event['event_image']);
            $related_tags = $event->getTags()->where('entity_type',2)->get();
            $event['tags'] = $related_tags;
        } 

        $all_business = Business::where('category_id',$input['q'])->paginate(4);
        foreach ($all_business as $business) {
            $business_count = count($business->getFavorite()->where('status',1)->get());
            $business['fav_count'] = $business_count;
            $business['business_image'] = explode(',', $business['business_image']);
            $related_tags = $business->getTags()->where('entity_type',1)->get();
            $business['tags'] = $related_tags;
        }

        $category_id = $input['q'];
        $category_name = Category::where('category_id',$input['q'])->pluck('name');

        $all_category = Category::where('parent',0)->get();
        foreach ($all_category as $category) {
            $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
        }

        return view('frontend.pages.funsober',compact('all_business','all_events','all_category','category_name','category_id'));
    }
}
