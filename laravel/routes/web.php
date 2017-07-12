<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('frontend.pages.index');
})->name('fronted_home');

Route::group(['prefix' => 'wireframe'], function() {
	Route::get('/community',function(){
		return view('frontend.pages.community-changed');
	})->name('frontend_community_page');

	Route::get('/offer',function(){
		return view('frontend.pages.offer-section');
	})->name('frontend_offer_page');

	Route::get('/loggedin',function(){
		return view('frontend.pages.loggedin');
	})->name('frontent_logged_in');

	Route::get('/profile',function(){
		return view('frontend.pages.profile');
	})->name('frontend_profile_page');

	Route::get('/shared-location',function(){
		return view('frontend.pages.shared-location');
	})->name('frontend_shared_location');

	Route::get('/my-favourite',function(){
		return view('frontend.pages.myfavourite');
	})->name('frontend_my_faourite');

	Route::get('/moreevent',function(){
		return view('frontend.pages.moreevent');
	})->name('frontend_more_event');

	Route::get('/shared-location-more',function(){
		return view('frontend.pages.shared-location-more');
	})->name('frontend_shared_location_more');

	Route::get('/shared-location-new',function(){
		return view('frontend.pages.shared-location-new');
	})->name('frontend_shared_location_new');

	Route::get('/create-event',function(){
		return view('frontend.pages.createevent');
	})->name('frontend_create_event');

	Route::get('/create-business',function(){
		return view('frontend.pages.createbusiness');
	})->name('frontend_create_business');

	Route::get('/acount-settings',function(){
		return view('frontend.pages.accountsetting');
	})->name('frontend_acount_settings');

	Route::get('/view-events',function(){
		return view('frontend.pages.viewevents');
	})->name('frontend_view_events');

	Route::get('/view-business',function(){
		return view('frontend.pages.viewbusiness');
	})->name('frontend_view_business');

	Route::get('/dining-category',function(){
		return view('frontend.pages.diningcategory');
	})->name('frontend_dining_category');

	Route::get('/helth_fitness-category',function(){
		return view('frontend.pages.healthfitnesscategory');
	})->name('frontend_health_fitmess');

	Route::get('/sports-category',function(){
		return view('frontend.pages.sportscategory');
	})->name('frontend_sports_category');

	Route::get('/fun_sober',function(){
		return view('frontend.pages.funsober');
	})->name('frontend_fun_sober');
});