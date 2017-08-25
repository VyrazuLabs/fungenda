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

    	$myFavoriteEvents = Auth::user()->getFavorites()->where('entity_type',2)->get();
    	echo "<pre>";
    	print_r($myFavoriteEvents);die();
    	foreach ($myFavoriteEvents as $value) {
    		$all_event = $value->getEvents()->get();
    		$all_events[] = $all_event;
    	}
    	
    	// echo "<pre>";
    	print_r($all_events);die();
    	// $all_events = Event::paginate(4);
      	foreach ($all_events as $event) {
          $event_count = count($event->getFavorite()->where('status',1)->get());
          $event['fav_count'] = $event_count;
          $img = explode(',',$event['event_image']);
      	  $event['image'] = $img;
          $related_tags = $event->getTags()->where('entity_type',2)->get();
          $event['tags'] = $related_tags;
      	}

    	return view('frontend.pages.myfavourite',compact('all_events'));
    }
}
