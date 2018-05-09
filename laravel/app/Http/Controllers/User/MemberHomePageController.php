<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Event;
use App\Models\SharedLocationMyFavorite;
use App\Models\ShareLocation;
use Auth;

class MemberHomePageController extends Controller
{
    /* Return members-homepage view */
    public function viewMembersHomePage()
    {
        $all_category = Category::where('parent', 0)->get();

        foreach ($all_category as $category) {
            $category['sub_category'] = Category::where('parent', $category['category_id'])->pluck('name', 'category_id');
        }

        // define arrays
        $all_event = [];
        $all_events = [];
        $all_business = [];
        $all_businesses = [];
        $all_share_location = [];

        //get favorite events
        $myFavoriteEvents = Auth::user()->getFavorites()->where('entity_type', 2)->where('status', 1)->get();
        foreach ($myFavoriteEvents as $key => $value) {
            if ($value) {
                $all_events[] = $value->getEvents()->get();
            }
        }
        foreach ($all_events as $event) {
            $event_count = count($event[0]->getFavorite()->where('status', 1)->get());
            $event[0]['fav_count'] = $event_count;
            $img = explode(',', $event[0]['event_image']);
            $event[0]['image'] = $img;
            $related_tags = $event[0]->getTags()->where('entity_type', 2)->get();
            $event[0]['tags'] = $related_tags;
            $event_discount = $event[0]->getEventOffer()->first()->discount_types;
            $event[0]['discount'] = $event_discount;
        }

        //get favorite businesses
        $myFavoriteBusinesses = Auth::user()->getFavorites()->where('entity_type', 1)->where('status', 1)->get();
        foreach ($myFavoriteBusinesses as $key => $value) {
            if ($value) {
                $all_businesses[] = $value->getBusiness()->get();
            }
        }
        foreach ($all_businesses as $business) {
            $business_count = count($business[0]->getFavorite()->where('status', 1)->get());
            $business[0]['fav_count'] = $business_count;
            $img = explode(',', $business[0]['business_image']);
            $business[0]['image'] = $img;
            $related_tags_business = $business[0]->getTags()->where('entity_type', 1)->get();
            $business[0]['tags'] = $related_tags_business;
            $business_discount = $business[0]->getBusinessOffer()->first()->business_discount_types;
            $business[0]['discount'] = $business_discount;
        }

        //get favorite  shared location
        $myFavouriteSharedLocation = SharedLocationMyFavorite::where('user_id', Auth::user()->user_id)->get();
        foreach ($myFavouriteSharedLocation as $key => $value) {
            if ($value) {
                $all_share_location[] = $value->getSharedLocation()->get();
            }
        }
        foreach ($all_share_location as $share_location) {
            $share_location_count = count(SharedLocationMyFavorite::where('shared_location_id', $share_location[0]['shared_location_id'])->get());
            $share_location[0]['fav_count'] = $share_location_count;
            $img = explode(',', $share_location[0]['file']);
            $share_location[0]['image'] = $img;
        }

        $myCreatedBusiness = Business::where('created_by', Auth::user()->user_id)->get();
        $myCreatedEvents = Event::where('created_by', Auth::user()->user_id)->get();
        $mySharedLocation = ShareLocation::where('user_id', Auth::user()->user_id)->get();

        return view('frontend.pages.members-homepage', compact('all_category', 'all_events', 'all_businesses', 'all_share_location', 'myCreatedBusiness', 'myCreatedEvents', 'mySharedLocation'));
    }
}
