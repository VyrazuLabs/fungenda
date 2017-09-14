<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Business;
use App\Models\Address;

class SearchController extends Controller
{
    public function search(Request $request){
    	$input = $request->input();
        echo "<pre>";print_r($input);die;
    	if($input['radio'] == 1){
    		// echo "business";
    		
    		$search_by_location = Business::where('business_venue','like','%'.$input['location'].'%')->get();
    		echo "<pre>";
    		print_r($search_by_location);
    	}
    	else{
    		echo "event";
    	}
    }
}
