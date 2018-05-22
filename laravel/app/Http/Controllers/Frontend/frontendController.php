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
use Session;

class frontendController extends Controller
{
	// return index page
    public function index(){
        Session::forget('input');
    	$all_events = Event::orderBy('id', 'DESC')->paginate(4);
    	foreach ($all_events as $event) {
            $event_count = count($event->getFavorite()->where('status',1)->get());
            $event['fav_count'] = $event_count;
    		$img = explode(',',$event['event_image']);
    		$event['image'] = $img;
            $related_tags = $event->getTags()->where('entity_type',2)->get();
            $event['tags'] = $related_tags;
            $event_discount = $event->getEventOffer()->first()->discount_types;
            $event['discount'] = $event_discount;
    	}
    	$all_business = Business::orderBy('id', 'DESC')->paginate(4);
    	foreach ($all_business as $business) {
            $business_count = count($business->getFavorite()->where('status',1)->get());
            $business['fav_count'] = $business_count;
    		$img = explode(',',$business['business_image']);
    		$business['image'] = $img;
            $related_tags = $business->getTags()->where('entity_type',1)->get();
            $business['tags'] = $related_tags;
            $business_discount = $business->getBusinessOffer()->first()->business_discount_types;
            $business['discount'] = $business_discount;
    	}
        $all_category = Category::where('category_status',1)->where('parent',0)->get();
        foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('category_status',1)->where('parent',$category['category_id'])->pluck('name','category_id');
            }
            // echo "<pre>";print_r($all_business);die;
        return view('frontend.pages.index',compact('all_events','all_business','all_category'));
    }

    // return category page
    public function getCategory(Request $request){
        $input = $request->input();

        if(!isset($input['q'])) {
            Session::flash('error', "Not a valid category");
            return redirect('/');
        }
        $category_found = Category::where('category_status',1)->where('category_id',$input['q'])->first();
        if(empty($category_found)){

            Session::flash('error', "Not a valid category");
            return redirect('/');
        }
        else{
            $all_events = Event::orderBy('id', 'DESC')->where('category_id',$input['q'])->paginate(4);
            foreach ($all_events as $event) {
                $event_count = count($event->getFavorite()->where('status',1)->get());
                $event['fav_count'] = $event_count;
                $event['event_image'] = explode(',', $event['event_image']);
                $related_tags = $event->getTags()->where('entity_type',2)->get();
                $event['tags'] = $related_tags;
                $event_discount = $event->getEventOffer()->first()->discount_types;
                $event['discount'] = $event_discount;
            } 

            $all_business = Business::orderBy('id', 'DESC')->where('category_id',$input['q'])->paginate(4);
            foreach ($all_business as $business) {
                $business_count = count($business->getFavorite()->where('status',1)->get());
                $business['fav_count'] = $business_count;
                $business['business_image'] = explode(',', $business['business_image']);
                $related_tags = $business->getTags()->where('entity_type',1)->get();
                $business['tags'] = $related_tags;
                $business_discount = $business->getBusinessOffer()->first()->business_discount_types;
                $business['discount'] = $business_discount;
            }

            $category_id = $input['q'];
            $category_name = Category::where('category_status',1)->where('category_id',$input['q'])->pluck('name');

            $all_category = Category::where('category_status',1)->where('parent',0)->get();
            foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('category_status',1)->where('parent',$category['category_id'])->pluck('name','category_id');
            }

            return view('frontend.pages.category',compact('all_business','all_events','all_category','category_name','category_id'));
        }
    }
}
