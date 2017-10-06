<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Business;
use App\Models\Address;
use App\Models\Tag;
use App\Models\AssociateTag;
use App\Models\Category;
use Session;


class SearchController extends Controller
{
    public function search(Request $request){
        $input = $request->input();
        // echo "<pre>";print_r($input);die;

        $user_latitude = Session::get('user_latitude');
        $user_longitude = Session::get('user_longitude');

        if($input['radio'] == 1){

            if(!empty($input['location'])){

                $location_array = explode(',',$input['location']);
                $all_search_business = Business::where('business_venue','like','%'.$location_array[0].'%')->get();

                foreach ($all_search_business as $business) {
                    $business_count = count($business->getFavorite()->where('status',1)->get());
                    $business['fav_count'] = $business_count;
                    $img = explode(',',$business['business_image']);
                    $business['image'] = $img;
                    $related_tags = $business->getTags()->where('entity_type',1)->get();
                    $business['tags'] = $related_tags;     
                }
                // echo "<pre>";
                // print_r($all_search_business);die();
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && !empty($input['tags'])){

                $tag_id_all = [];
                $tag_details_all = [];
                $all_user_id = [];
                $all_tag_user_details = [];
                $final_tags_array = [];
                $final_unique_value_tags_array_business_id = [];
                $all_search_tags = [];
                $all_search_business = [];

                foreach ($input['tags'] as $tag) {
                    $tag_details = Tag::where('tag_name',$tag)->first();
                    if(!empty($tag_details)){
                        $tag_id = $tag_details->tag_id;  
                        $tag_id_all[] = $tag_id;
                    } 
                }
                foreach ($tag_id_all as $tag_id) {
                    $tag_user_details = AssociateTag::where('tags_id','like','%'.$tag_id.'%')->where('entity_type',1)->get();
                    $all_tag_user_details[] = $tag_user_details;
                }
                foreach ($all_tag_user_details as $single_tag_user_details) {
                    foreach ($single_tag_user_details as $key => $value) {
                        $final_tags_array[] = $value;
                    }
                }
                $final_unique_value_tags_array = array_unique($final_tags_array);
                foreach ($final_unique_value_tags_array as $final_unique_value_tags_user_id) {
                    $final_unique_value_tags_array_business_id[] = $final_unique_value_tags_user_id['entity_id'];
                }
                foreach ($final_unique_value_tags_array_business_id as $business_id) {
                    $business_data = Business::where('business_id',$business_id)->first();
                    if(!empty($business_data)){
                        $search_by_tag[] = $business_data;
                    }
                    $all_search_business = $search_by_tag;
                }
                foreach ($all_search_business as $business) {
                    $business_count = count($business->getFavorite()->where('status',1)->get());
                    $business['fav_count'] = $business_count;
                    $img = explode(',',$business['business_image']);
                    $business['image'] = $img;
                    $related_tags = $business->getTags()->where('entity_type',1)->get();
                    $business['tags'] = $related_tags;     
                }
            }
            // echo "<pre>";
            if(empty($input['location']) && $input['radius'] != 'Radius'){
                $all_business = Business::all();
                if($input['radius'] == 1){
                    foreach ($all_business as $single_business) {

                    $lat = pow(($user_latitude - $single_business['business_lat']),2);
                    $long = pow(($user_longitude - $single_business['business_long']),2);
                    $data = sqrt($lat+$long);
                        if($data <=1){
                            $all_search_business[] = $single_business;    
                        }
                    
                    }
                    // echo "<pre>";print_r($all_search_business);die;
                    foreach ($all_search_business as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                    }
                }
                if($input['radius'] == 2){
                    foreach ($all_business as $single_business) {

                    $lat = pow(($user_latitude - $single_business['business_lat']),2);
                    $long = pow(($user_longitude - $single_business['business_long']),2);
                    $data = sqrt($lat+$long);
                        if($data <=2){
                            $all_search_business[] = $single_business;    
                        }
                    
                    }
                    foreach ($all_search_business as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                    }
                }
                if($input['radius'] == 3){
                    foreach ($all_business as $single_business) {

                        $lat = pow(($user_latitude - $single_business['business_lat']),2);
                        $long = pow(($user_longitude - $single_business['business_long']),2);
                        $data = sqrt($lat+$long);
                        if($data <=3){
                            $all_search_business[] = $single_business;    
                        }
                    
                    }
                    foreach ($all_search_business as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                    }
                }
                // print_r($all_search_business);
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && empty($input['tags']) && isset($input['checkbox1'])){
                if($input['checkbox1'] == 1){
                   $all_business = Business::all();
                   foreach ($all_business as $single_business) {
                        if($single_business->getBusinessOffer->business_discount_types == 1){
                            $all_search_business[] = $single_business;
                        }
                   }
                   foreach ($all_search_business as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                    }
                }
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && empty($input['tags']) && isset($input['checkbox2'])){
                if($input['checkbox2'] == 2){
                   $all_business = Business::all();
                   foreach ($all_business as $single_business) {
                        if($single_business->getBusinessOffer->business_discount_types == 2){
                            $all_search_business[] = $single_business;
                        }
                   }
                   foreach ($all_search_business as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                    }
                }
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && empty($input['tags']) && isset($input['checkbox3'])){
                if($input['checkbox3'] == 3){
                   $all_business = Business::all();
                   foreach ($all_business as $single_business) {
                        if($single_business->getBusinessOffer->business_discount_types == 1 || $single_business->getBusinessOffer->business_discount_types == 2){
                            $all_search_business[] = $single_business;
                        }
                   }
                   foreach ($all_search_business as $business) {
                        $business_count = count($business->getFavorite()->where('status',1)->get());
                        $business['fav_count'] = $business_count;
                        $img = explode(',',$business['business_image']);
                        $business['image'] = $img;
                        $related_tags = $business->getTags()->where('entity_type',1)->get();
                        $business['tags'] = $related_tags;
                    }
                }
            }
            // die;
            $all_category = Category::where('parent',0)->get();
                foreach ($all_category as $category) {
                        $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                    }
            return view('frontend.pages.index',compact('all_search_business','all_category'));
        }
        else{
            if(!empty($input['location'])){

                $location_array = explode(',',$input['location']);
                $all_search_events = Event::where('event_venue','like','%'.$location_array[0].'%')->get();

                foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;     
                }
                // echo "<pre>";
                // print_r($all_search_events);die();
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && !empty($input['tags'])){

                $tag_id_all = [];
                $tag_details_all = [];
                $all_user_id = [];
                $all_tag_user_details = [];
                $final_tags_array = [];
                $final_unique_value_tags_array_business_id = [];
                $all_search_tags = [];
                $all_search_events = [];

                foreach ($input['tags'] as $tag) {
                    $tag_details = Tag::where('tag_name',$tag)->first();
                    if(!empty($tag_details)){
                        $tag_id = $tag_details->tag_id;  
                        $tag_id_all[] = $tag_id;
                    } 
                }
                foreach ($tag_id_all as $tag_id) {
                    $tag_user_details = AssociateTag::where('tags_id','like','%'.$tag_id.'%')->where('entity_type',2)->get();
                    $all_tag_user_details[] = $tag_user_details;
                }
                foreach ($all_tag_user_details as $single_tag_user_details) {
                    foreach ($single_tag_user_details as $key => $value) {
                        $final_tags_array[] = $value;
                    }
                }
                $final_unique_value_tags_array = array_unique($final_tags_array);
                foreach ($final_unique_value_tags_array as $final_unique_value_tags_user_id) {
                    $final_unique_value_tags_array_business_id[] = $final_unique_value_tags_user_id['entity_id'];
                }
                foreach ($final_unique_value_tags_array_business_id as $business_id) {
                    $event_data = Event::where('event_id',$business_id)->first();
                    if(!empty($event_data)){
                        $search_by_tag[] = $event_data;
                    }
                    $all_search_events = $search_by_tag;
                }
                foreach ($all_search_events as $event) {
                    $business_count = count($event->getFavorite()->where('status',1)->get());
                    $event['fav_count'] = $business_count;
                    $img = explode(',',$event['event_image']);
                    $event['image'] = $img;
                    $related_tags = $event->getTags()->where('entity_type',2)->get();
                    $event['tags'] = $related_tags;     
                }
            }
            if(empty($input['location']) && $input['radius'] != 'Radius'){
                $all_events = Event::all();
                if($input['radius'] == 1){
                    foreach ($all_events as $single_event) {

                    $lat = pow(($user_latitude - $single_event['event_lat']),2);
                    $long = pow(($user_longitude - $single_event['event_long']),2);
                    $data = sqrt($lat+$long);
                        if($data <=1){
                            $all_search_events[] = $single_event;    
                        }
                    
                    }
                    foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;
                    }
                }
                if($input['radius'] == 2){
                    foreach ($all_events as $single_event) {

                    $lat = pow(($user_latitude - $single_event['event_lat']),2);
                    $long = pow(($user_longitude - $single_event['event_long']),2);
                    $data = sqrt($lat+$long);
                        if($data <=2){
                            $all_search_events[] = $single_event;    
                        }
                    
                    }
                    foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;
                    }
                }
                if($input['radius'] == 3){
                    foreach ($all_events as $single_event) {

                    $lat = pow(($user_latitude - $single_event['event_lat']),2);
                    $long = pow(($user_longitude - $single_event['event_long']),2);
                    $data = sqrt($lat+$long);
                        if($data <=3){
                            $all_search_events[] = $single_event;    
                        }
                    
                    }
                    foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;
                    }
                }
                // print_r($all_search_business);
            }
            if(isset($input['fromdate']) && isset($input['todate'])){
                $all_search_events = [];
                $given_from_date = strtotime($input['fromdate']);
                $given_to_date = strtotime($input['todate']);

                $all_events = Event::all();
                foreach ($all_events as $single_event) {
                    if(strtotime($single_event['event_start_date']) == $given_from_date && strtotime($single_event['event_end_date']) == $given_to_date){
                        $all_search_events[] = $single_event;
                    }
                }
                foreach ($all_search_events as $event) {
                    $business_count = count($event->getFavorite()->where('status',1)->get());
                    $event['fav_count'] = $business_count;
                    $img = explode(',',$event['event_image']);
                    $event['image'] = $img;
                    $related_tags = $event->getTags()->where('entity_type',2)->get();
                    $event['tags'] = $related_tags;
                }
                // echo "<pre>";print_r($all_search_events);      
            }
            if(isset($input['fromdate'])){
                $all_search_events = [];
                // echo "<pre>";
                $given_from_date = strtotime($input['fromdate']);
                $all_events = Event::all();
                foreach ($all_events as $single_event) {
                    if(strtotime($single_event['event_start_date']) == $given_from_date){
                        $all_search_events[] = $single_event;
                    }
                }
                foreach ($all_search_events as $event) {
                    $business_count = count($event->getFavorite()->where('status',1)->get());
                    $event['fav_count'] = $business_count;
                    $img = explode(',',$event['event_image']);
                    $event['image'] = $img;
                    $related_tags = $event->getTags()->where('entity_type',2)->get();
                    $event['tags'] = $related_tags;
                }
            }
            if(isset($input['todate'])){
                $all_search_events = [];
                // echo "<pre>";
                $given_to_date = strtotime($input['todate']);
                $all_events = Event::all();
                foreach ($all_events as $single_event) {
                    if(strtotime($single_event['event_end_date']) == $given_to_date){
                        $all_search_events[] = $single_event;
                    }
                }
                foreach ($all_search_events as $event) {
                    $business_count = count($event->getFavorite()->where('status',1)->get());
                    $event['fav_count'] = $business_count;
                    $img = explode(',',$event['event_image']);
                    $event['image'] = $img;
                    $related_tags = $event->getTags()->where('entity_type',2)->get();
                    $event['tags'] = $related_tags;
                }
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && empty($input['tags']) && isset($input['checkbox1'])){
                if($input['checkbox1'] == 1){
                   $all_event = Event::all();
                   foreach ($all_event as $single_event) {
                        if($single_event->getEventOffer->discount_types == 1){
                            $all_search_events[] = $single_event;
                        }
                   }
                   foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;
                    }
                }
            }
            if(empty($input['location']) && $input['radius'] == 'Radius' && empty($input['tags']) && isset($input['checkbox2'])){
                if($input['checkbox2'] == 2){
                   $all_event = Event::all();
                   foreach ($all_event as $single_event) {
                        if($single_event->getEventOffer->discount_types == 2){
                            $all_search_events[] = $single_event;
                        }
                   }
                   foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;
                    }
                }
            }
            if(isset($input['checkbox3'])){
                if($input['checkbox3'] == 3){
                   $all_event = Event::all();
                   foreach ($all_event as $single_event) {
                        if($single_event->getEventOffer->discount_types == 1 || $single_event->getEventOffer->discount_types == 2){
                            $all_search_events[] = $single_event;
                        }
                   }
                   foreach ($all_search_events as $event) {
                        $business_count = count($event->getFavorite()->where('status',1)->get());
                        $event['fav_count'] = $business_count;
                        $img = explode(',',$event['event_image']);
                        $event['image'] = $img;
                        $related_tags = $event->getTags()->where('entity_type',2)->get();
                        $event['tags'] = $related_tags;
                    }
                }
            }
            // die;

            $all_category = Category::where('parent',0)->get();
                foreach ($all_category as $category) {
                        $category['sub_category'] = Category::where('parent',$category['category_id'])->pluck('name','category_id');
                    }
            return view('frontend.pages.index',compact('all_search_events','all_category'));
           }
    }

    // Set session for getting latitude and longitude
    public function session(Request $request){
        $input = $request->input();
        $latitude = $input['latitude'];
        $longitude = $input['longitude'];
        Session::put('user_latitude',$latitude);
        Session::put('user_longitude',$longitude);
    }
}
