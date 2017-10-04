<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\MyFavorite;
use Auth;

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

    
}
