<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SharedLocationMyFavorite;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;
use Session;

class MyFavouriteController extends Controller
{
    // Return view of my favourite
    public function viewMyFavourite()
    {

        // define arrays
        $all_event = [];
        $all_events = [];
        $all_business = [];
        $all_businesses = [];
        $all_share_location = [];

        //get favorite events
        $myFavoriteEvents = Auth::user()->getFavorites()->where('entity_type', 2)->where('status', 1)->get();
        if (!empty($myFavoriteEvents)) {
            foreach ($myFavoriteEvents as $key => $value) {
                if ($value) {
                    $all_events[] = $value->getEvents()->get();
                }
            }
        }

        if (!empty($all_events)) {
            foreach ($all_events as $event) {
                $event_count = count($event[0]->getFavorite()->where('status', 1)->get());
                $event[0]['fav_count'] = $event_count;
                $img = explode(',', $event[0]['event_image']);
                $event[0]['image'] = $img;
                $related_tags = $event[0]->getTags()->where('entity_type', 2)->get();
                $event[0]['tags'] = $related_tags;
                $event_discount = $event[0]->getEventOffer()->first()->discount_types;
                $event[0]['discount'] = $event_discount;
                $event[0]['discount_rate'] = $event[0]->getEventOffer->discount_rate;
            }
        }

        //get favorite businesses
        $myFavoriteBusinesses = Auth::user()->getFavorites()
            ->where('entity_type', 1)
            ->where('status', 1)
            ->get();

        if (!empty($myFavoriteBusinesses)) {
            foreach ($myFavoriteBusinesses as $key => $value) {
                if ($value) {
                    $all_businesses[] = $value->getBusiness()->get();
                }
            }
        }

        if (!empty($all_businesses)) {
            foreach ($all_businesses as $business) {
                $business_count = count($business[0]->getFavorite()->where('status', 1)->get());
                $business[0]['fav_count'] = $business_count;
                $img = explode(',', $business[0]['business_image']);
                $business[0]['image'] = $img;
                $related_tags_business = $business[0]->getTags()->where('entity_type', 1)->get();
                $business[0]['tags'] = $related_tags_business;
                $business_discount = $business[0]->getBusinessOffer()->first()->business_discount_types;
                $business[0]['discount'] = $business_discount;
                $business[0]['discount_rate'] = $business[0]->getBusinessOffer->business_discount_rate;
            }
        }

        //get favorite  shared location
        $myFavouriteSharedLocation = SharedLocationMyFavorite::where('user_id', Auth::user()->user_id)->get();
        if (!empty($myFavouriteSharedLocation)) {
            foreach ($myFavouriteSharedLocation as $key => $value) {

                if ($value) {
                    $all_share_location = $value->getSharedLocation()->get();
                    // $all_share_location[] = $value->getSharedLocation()->get();
                }
            }
        }

        if (!empty($all_share_location)) {
            foreach ($all_share_location as $share_location) {
                $share_location_count = count(SharedLocationMyFavorite::where('shared_location_id', $share_location[0]['shared_location_id'])->get());
                $share_location[0]['fav_count'] = $share_location_count;
                $img = explode(',', $share_location[0]['file']);
                $share_location[0]['image'] = $img;
            }
        }
        // echo "<pre>";
        // print_r($all_share_location);die;
        return view('frontend.pages.myfavourite', compact('all_events', 'all_businesses', 'all_share_location'));
    }

    public function getSearch()
    {
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

        return view('frontend.pages.myfavourite', compact('all_events', 'all_businesses', 'all_share_location'));
    }

    /* Function for search functionality */
    public function search(Request $request)
    {
        $input = $request->input();
        Session::forget('radio');

        if (isset($input['radio'])) {
            if ($input['radio'] == 1) {
                if (!empty($input['tags'])) {
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
                        $tag_details = Tag::where('tag_name', 'like', '%' . $tag . '%')->first();
                        if (!empty($tag_details)) {
                            $tag_id = $tag_details->tag_id;
                            $tag_id_all[] = $tag_id;
                        }
                    }

                    foreach ($tag_id_all as $tag_id) {
                        foreach ($this->viewMyFavourite()->all_businesses as $single_business) {
                            if (!empty($single_business[0]['tags'][0])) {
                                $tag_id_array = unserialize($single_business[0]['tags'][0]['tags_id']);
                                if (in_array($tag_id, $tag_id_array)) {
                                    $all_search_business[] = $single_business;
                                }
                            }
                        }
                    }

                    Session::put('radio', 1);
                    return view('frontend.pages.myfavourite', compact('all_search_business'));
                } else {

                    $all_event = [];
                    $all_events = [];
                    $all_business = [];
                    $all_search_business = [];
                    //get favorite businesses
                    $myFavoriteBusinesses = Auth::user()->getFavorites()->where('entity_type', 1)->where('status', 1)->get();
                    foreach ($myFavoriteBusinesses as $key => $value) {
                        if ($value) {
                            $all_search_business[] = $value->getBusiness()->get();
                        }
                    }
                    foreach ($all_search_business as $business) {
                        $business_count = count($business[0]->getFavorite()->where('status', 1)->get());
                        $business[0]['fav_count'] = $business_count;
                        $img = explode(',', $business[0]['business_image']);
                        $business[0]['image'] = $img;
                        $related_tags_business = $business[0]->getTags()->where('entity_type', 1)->get();
                        $business[0]['tags'] = $related_tags_business;
                        $related_tags_business = $business[0]->getTags()->where('entity_type', 1)->get();
                        $business[0]['tags'] = $related_tags_business;
                        $business_discount = $business[0]->getBusinessOffer()->first()->business_discount_types;
                        $business[0]['discount'] = $business_discount;
                    }
                    Session::put('radio', 1);
                    return view('frontend.pages.myfavourite', compact('all_search_business'));
                }
            }

            if ($input['radio'] == 2) {

                if (!empty($input['tags'])) {
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
                        $tag_details = Tag::where('tag_name', 'like', '%' . $tag . '%')->first();
                        if (!empty($tag_details)) {
                            $tag_id = $tag_details->tag_id;
                            $tag_id_all[] = $tag_id;
                        }
                    }

                    foreach ($tag_id_all as $tag_id) {
                        foreach ($this->viewMyFavourite()->all_events as $single_events) {
                            if (!empty($single_events[0]['tags'][0])) {
                                $tag_id_array = unserialize($single_events[0]['tags'][0]['tags_id']);
                                if (in_array($tag_id, $tag_id_array)) {
                                    $all_search_events[] = $single_events;
                                }
                            }
                        }
                    }
                    Session::put('radio', 2);
                    return view('frontend.pages.myfavourite', compact('all_search_events'));
                } else {
                    // define arrays
                    $all_event = [];
                    $all_search_events = [];
                    $all_business = [];
                    $all_businesses = [];

                    //get favorite events
                    $myFavoriteEvents = Auth::user()->getFavorites()->where('entity_type', 2)->where('status', 1)->get();
                    foreach ($myFavoriteEvents as $key => $value) {
                        if ($value) {
                            $all_search_events[] = $value->getEvents()->get();
                        }
                    }
                    foreach ($all_search_events as $event) {
                        $event_count = count($event[0]->getFavorite()->where('status', 1)->get());
                        $event[0]['fav_count'] = $event_count;
                        $img = explode(',', $event[0]['event_image']);
                        $event[0]['image'] = $img;
                        $related_tags = $event[0]->getTags()->where('entity_type', 2)->get();
                        $event[0]['tags'] = $related_tags;
                        $related_tags = $event[0]->getTags()->where('entity_type', 2)->get();
                        $event[0]['tags'] = $related_tags;
                        $event_discount = $event[0]->getEventOffer()->first()->discount_types;
                        $event[0]['discount'] = $event_discount;
                    }
                    Session::put('radio', 2);
                    return view('frontend.pages.myfavourite', compact('all_search_events'));
                }
            }

            if ($input['radio'] == 3) {
                if (!empty($input['tags'])) {
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
                        $tag_details = Tag::where('tag_name', 'like', '%' . $tag . '%')->first();
                        if (!empty($tag_details)) {
                            $tag_id = $tag_details->tag_id;
                            $tag_id_all[] = $tag_id;
                        }
                    }

                    foreach ($tag_id_all as $tag_id) {
                        foreach ($this->viewMyFavourite()->all_businesses as $single_business) {
                            if (!empty($single_business[0]['tags'][0])) {
                                $tag_id_array = unserialize($single_business[0]['tags'][0]['tags_id']);
                                if (in_array($tag_id, $tag_id_array)) {
                                    $all_search_business[] = $single_business;
                                }
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
                        $tag_details = Tag::where('tag_name', 'like', '%' . $tag . '%')->first();
                        if (!empty($tag_details)) {
                            $tag_id = $tag_details->tag_id;
                            $tag_id_all[] = $tag_id;
                        }
                    }

                    foreach ($tag_id_all as $tag_id) {
                        foreach ($this->viewMyFavourite()->all_events as $single_events) {
                            if (!empty($single_events[0]['tags'][0])) {
                                $tag_id_array = unserialize($single_events[0]['tags'][0]['tags_id']);
                                if (in_array($tag_id, $tag_id_array)) {
                                    $all_search_events[] = $single_events;
                                }
                            }
                        }
                    }
                    Session::put('radio', 3);
                    return view('frontend.pages.myfavourite', compact('all_search_business', 'all_search_events'));
                } else {

                    // define arrays
                    $all_event = [];
                    $all_search_events = [];
                    $all_business = [];
                    $all_search_business = [];

                    //get favorite events
                    $myFavoriteEvents = Auth::user()->getFavorites()->where('entity_type', 2)->where('status', 1)->get();
                    foreach ($myFavoriteEvents as $key => $value) {
                        if ($value) {
                            $all_search_events[] = $value->getEvents()->get();
                        }
                    }
                    foreach ($all_search_events as $event) {
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
                            $all_search_business[] = $value->getBusiness()->get();
                        }
                    }
                    foreach ($all_search_business as $business) {
                        $business_count = count($business[0]->getFavorite()->where('status', 1)->get());
                        $business[0]['fav_count'] = $business_count;
                        $img = explode(',', $business[0]['business_image']);
                        $business[0]['image'] = $img;
                        $related_tags_business = $business[0]->getTags()->where('entity_type', 1)->get();
                        $business[0]['tags'] = $related_tags_business;
                        $related_tags_business = $business[0]->getTags()->where('entity_type', 1)->get();
                        $business[0]['tags'] = $related_tags_business;
                        $business_discount = $business[0]->getBusinessOffer()->first()->business_discount_types;
                        $business[0]['discount'] = $business_discount;
                    }
                    Session::put('radio', 3);
                    return view('frontend.pages.myfavourite', compact('all_search_business', 'all_search_events'));
                }
            }
        } else {
            return back();
        }

    }
}
