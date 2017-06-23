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
});
Route::get('/community',function(){
	return view('frontend.pages.community-changed');
});
Route::get('/offer',function(){
	return view('frontend.pages.offer-section');
});
Route::get('/loggedin',function(){
	return view('frontend.pages.loggedin');
});
Route::get('/profile',function(){
	return view('frontend.pages.profile');
});
Route::get('/shared-location',function(){
	return view('frontend.pages.shared-location');
});
Route::get('/myfav',function(){
	return view('frontend.pages.myfavourite');
});
//work has not done yet
Route::get('/eventmore',function(){
	return view('frontend.pages.eventmore');
});
Route::get('/shared-location-more',function(){
	return view('frontend.pages.shared-location-more');
});
Route::get('/shared-location-new',function(){
	return view('frontend.pages.shared-location-new');
});
