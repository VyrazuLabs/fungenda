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

});