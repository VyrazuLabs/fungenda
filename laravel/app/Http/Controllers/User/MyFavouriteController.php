<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\MyFavorite;
use Auth;
use App\Models\Tag;
use App\Models\AssociateTag;
use App\Models\Business;

class MyFavouriteController extends Controller
{
	// Return view of my favourite
    public function viewMyFavourite(){

      // define arrays
      $all_event = [];
      $all_events = [];
      $all_business = [];
      $all_businesses = [];


      //get favorite events
    	$myFavoriteEvents = Auth::user()->getFavorites()->where('entity_type',2)->where('status',1)->get();
    	foreach ($myFavoriteEvents as $key=>$value) {
        if($value){
          $all_events[] = $value->getEvents()->get();
        }
    	}
      	foreach ($all_events as $event) {
          $event_count = count($event[0]->getFavorite()->where('status',1)->get());
          $event[0]['fav_count'] = $event_count;
          $img = explode(',',$event[0]['event_image']);
      	  $event[0]['image'] = $img;
          $related_tags = $event[0]->getTags()->where('entity_type',2)->get();
          $event[0]['tags'] = $related_tags;
      	}

      //get favorite businesses
      $myFavoriteBusinesses = Auth::user()->getFavorites()->where('entity_type',1)->where('status',1)->get();
      foreach ($myFavoriteBusinesses as $key=>$value) {
        if($value){
          $all_businesses[] = $value->getBusiness()->get();
        }
      }
        foreach ($all_businesses as $business) {
          $business_count = count($business[0]->getFavorite()->where('status',1)->get());
          $business[0]['fav_count'] = $business_count;
          $img = explode(',',$business[0]['business_image']);
          $business[0]['image'] = $img;
          $related_tags_business = $business[0]->getTags()->where('entity_type',1)->get();
          $business[0]['tags'] = $related_tags_business;
        }

    	return view('frontend.pages.myfavourite',compact('all_events','all_businesses'));
    }

    /* Function for search functionality */
    public function search(Request $request){
      $input = $request->input();

      if($input['radio'] == 1){
        if(!empty($input['tags'])){
          $tag_id_all = [];
          $tag_details_all = [];
          $all_user_id = [];
          $all_tag_user_details = [];
          $final_tags_array = [];
          $final_unique_value_tags_array_business_id = [];
          $all_search_tags = [];
          $all_search_business = [];
          $selected_events = [];
          $all_search_busines = [];

          foreach ($input['tags'] as $tag) {
            $tag_details = Tag::where('tag_name','like','%'.$tag.'%')->first();
            if(!empty($tag_details)){
                $tag_id = $tag_details->tag_id;  
                $tag_id_all[] = $tag_id;
            } 
          }

          foreach ($tag_id_all as $tag_id) {
            foreach ($this->viewMyFavourite()->all_businesses as $single_business) {
              $tag_id_array = unserialize($single_business[0]['tags'][0]['tags_id']);
              if(in_array($tag_id,$tag_id_array)){
                $all_search_business[] = $single_business;
              }
            }
          }

          return view('frontend.pages.myfavourite',compact('all_search_business'));
        }
      }

      if($input['radio'] == 2){
        if(!empty($input['tags'])){
          $tag_id_all = [];
          $tag_details_all = [];
          $all_user_id = [];
          $all_tag_user_details = [];
          $final_tags_array = [];
          $final_unique_value_tags_array_business_id = [];
          $all_search_tags = [];
          $all_search_events = [];
          $selected_events = [];
          $all_search_event = [];

          foreach ($input['tags'] as $tag) {
            $tag_details = Tag::where('tag_name','like','%'.$tag.'%')->first();
            if(!empty($tag_details)){
                $tag_id = $tag_details->tag_id;  
                $tag_id_all[] = $tag_id;
            } 
          }

          foreach ($tag_id_all as $tag_id) {
            foreach ($this->viewMyFavourite()->all_events as $single_events) {
              $tag_id_array = unserialize($single_events[0]['tags'][0]['tags_id']);
              if(in_array($tag_id,$tag_id_array)){
                $all_search_events[] = $single_events;
              }
            }
          }

          // echo "<pre>";print_r($all_search_events);die;
          return view('frontend.pages.myfavourite',compact('all_search_events'));
        }
      }

      if($input['radio'] == 3){
        if(!empty($input['tags'])){
          $tag_id_all = [];
          $tag_details_all = [];
          $all_user_id = [];
          $all_tag_user_details = [];
          $final_tags_array = [];
          $final_unique_value_tags_array_business_id = [];
          $all_search_tags = [];
          $all_search_business = [];
          $selected_events = [];
          $all_search_busines = [];

          foreach ($input['tags'] as $tag) {
            $tag_details = Tag::where('tag_name','like','%'.$tag.'%')->first();
            if(!empty($tag_details)){
                $tag_id = $tag_details->tag_id;  
                $tag_id_all[] = $tag_id;
            } 
          }

          foreach ($tag_id_all as $tag_id) {
            foreach ($this->viewMyFavourite()->all_businesses as $single_business) {
              $tag_id_array = unserialize($single_business[0]['tags'][0]['tags_id']);
              if(in_array($tag_id,$tag_id_array)){
                $all_search_business[] = $single_business;
              }
            }
          }

          $tag_id_all = [];
          $tag_details_all = [];
          $all_user_id = [];
          $all_tag_user_details = [];
          $final_tags_array = [];
          $final_unique_value_tags_array_business_id = [];
          $all_search_tags = [];
          $all_search_events = [];
          $selected_events = [];
          $all_search_event = [];

          foreach ($input['tags'] as $tag) {
            $tag_details = Tag::where('tag_name','like','%'.$tag.'%')->first();
            if(!empty($tag_details)){
                $tag_id = $tag_details->tag_id;  
                $tag_id_all[] = $tag_id;
            } 
          }

          foreach ($tag_id_all as $tag_id) {
            foreach ($this->viewMyFavourite()->all_events as $single_events) {
              $tag_id_array = unserialize($single_events[0]['tags'][0]['tags_id']);
              if(in_array($tag_id,$tag_id_array)){
                $all_search_events[] = $single_events;
              }
            }
          }

          return view('frontend.pages.myfavourite',compact('all_search_business','all_search_events'));
        }
      }
    }
}
