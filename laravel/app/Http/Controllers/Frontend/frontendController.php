<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Session;

class frontendController extends Controller
{
    // return index page
    public function index()
    {
        Session::forget('input');
        $current_date = date("Y-m-d");
        $all_events = [];
        $all_business = [];
        $totalEvents = [];

        // $all_events = Event::orderBy('id', 'DESC')->paginate(4);
        $total_events = Event::orderBy('id', 'DESC')->get();
        foreach ($total_events as $event) {
            $event_count = count($event->getFavorite()->where('status', 1)->get());
            $event['fav_count'] = $event_count;
            $img = explode(',', $event['event_image']);
            $event['image'] = $img;
            $related_tags = $event->getTags()->where('entity_type', 2)->get();
            $event['tags'] = $related_tags;
            $event_discount = $event->getEventOffer()->first()->discount_types;
            $event['discount'] = $event_discount;
            $event['discount_rate'] = $event->getEventOffer->discount_rate;

            $event['start_dates'] = explode(',', $event['event_start_date']);
            if (!empty($event['start_dates'])) {
                foreach ($event['start_dates'] as $key => $start_date) {
                    /*  check wheather the date has passed away or not
                     * and set status
                     */
                    if ($start_date >= $current_date) {
                        $event['show_event_status'] = 1; // within date range
                    } else {
                        $event['show_event_status'] = 0; // date passed away
                    }
                }
            }

        }

        /* make an array of upcoming events */
        foreach ($total_events as $get_event) {
            if ($get_event['show_event_status'] == 1) {
                $totalEvents[] = $get_event;
            }
        }

        $all_events = $totalEvents;

        // Custom pagination //
        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        //Create a new Laravel collection from the array data
        $collection = new Collection($all_events);
        //Define how many items we want to be visible in each page
        $perPage = 4;
        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        //Create our paginator and pass it to the view
        $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $all_events = $paginatedSearchResults;

        // $all_business = Business::orderBy('id', 'DESC')->paginate(4);
        $all_business = Business::orderBy('id', 'DESC')->get();
        foreach ($all_business as $business) {
            $business_count = count($business->getFavorite()->where('status', 1)->get());
            $business['fav_count'] = $business_count;
            $img = explode(',', $business['business_image']);
            $business['image'] = $img;
            $related_tags = $business->getTags()->where('entity_type', 1)->get();
            $business['tags'] = $related_tags;
            $business_discount = $business->getBusinessOffer()->first()->business_discount_types;
            $business['discount'] = $business_discount;
            $business['discount_rate'] = $business->getBusinessOffer->business_discount_rate;
        }

        // // Custom pagination //
        //Get current page form url e.g. &page=6
        $businessCurrentPage = LengthAwarePaginator::resolveCurrentPage();
        //Create a new Laravel collection from the array data
        $businessCollection = new Collection($all_business);
        //Define how many items we want to be visible in each page
        $businessPerPage = 4;
        //Slice the collection to get the items to display in current page
        $businessCurrentPageSearchResults = $businessCollection->slice(($businessCurrentPage - 1) * $businessPerPage, $businessPerPage)->all();
        //Create our paginator and pass it to the view
        $businessPaginatedSearchResults = new LengthAwarePaginator($businessCurrentPageSearchResults, count($businessCollection), $businessPerPage);
        $all_business = $businessPaginatedSearchResults;

        $all_category = Category::where('category_status', 1)->where('parent', 0)->get();
        foreach ($all_category as $category) {
            $category['sub_category'] = Category::where('category_status', 1)->where('parent', $category['category_id'])->pluck('name', 'category_id');
        }

        return view('frontend.pages.index', compact('all_events', 'all_business', 'all_category'));
    }

    // return category page
    public function getCategory(Request $request)
    {
        $input = $request->input();
        $current_date = date("Y-m-d");

        if (!isset($input['q'])) {
            Session::flash('error', "Not a valid category");
            return redirect('/');
        }
        $category_found = Category::where('category_status', 1)->where('category_id', $input['q'])->first();
        if (empty($category_found)) {

            Session::flash('error', "Not a valid category");
            return redirect('/');
        } else {
            $all_events = Event::orderBy('id', 'DESC')->where('category_id', $input['q'])->paginate(4);
            foreach ($all_events as $event) {
                $event_count = count($event->getFavorite()->where('status', 1)->get());
                $event['fav_count'] = $event_count;
                $event['event_image'] = explode(',', $event['event_image']);
                $related_tags = $event->getTags()->where('entity_type', 2)->get();
                $event['tags'] = $related_tags;
                $event_discount = $event->getEventOffer()->first()->discount_types;
                $event['discount'] = $event_discount;
                $event['discount_rate'] = $event->getEventOffer->discount_rate;

                $event['start_dates'] = explode(',', $event['event_start_date']);
                if (!empty($event['start_dates'])) {
                    foreach ($event['start_dates'] as $key => $start_date) {
                        /*  check wheather the date has passed away or not
                         * and set status
                         */
                        if ($start_date >= $current_date) {
                            $event['show_event_status'] = 1; // within date range
                        } else {
                            $event['show_event_status'] = 0; // date passed away
                        }
                    }
                }
            }

            $all_business = Business::orderBy('id', 'DESC')->where('category_id', $input['q'])->paginate(4);
            foreach ($all_business as $business) {
                $business_count = count($business->getFavorite()->where('status', 1)->get());
                $business['fav_count'] = $business_count;
                $business['business_image'] = explode(',', $business['business_image']);
                $related_tags = $business->getTags()->where('entity_type', 1)->get();
                $business['tags'] = $related_tags;
                $business_discount = $business->getBusinessOffer()->first()->business_discount_types;
                $business['discount'] = $business_discount;
                $business['discount_rate'] = $business->getBusinessOffer->business_discount_rate;
            }

            $category_id = $input['q'];
            $category_name = Category::where('category_status', 1)->where('category_id', $input['q'])->pluck('name');

            $all_category = Category::where('category_status', 1)->where('parent', 0)->get();
            foreach ($all_category as $category) {
                $category['sub_category'] = Category::where('category_status', 1)->where('parent', $category['category_id'])->pluck('name', 'category_id');
            }

            return view('frontend.pages.category', compact('all_business', 'all_events', 'all_category', 'category_name', 'category_id'));
        }
    }
}
