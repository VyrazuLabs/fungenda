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
Route::group(['namespace' => 'Frontend'],function(){
	Route::get('/','frontendController@index')->name('fronted_home');
	Route::get('/category','frontendController@getCategory')->name('frontend_category');
});

Route::post('/user_registration','User\AuthController@userRegistration');
Route::post('/login','User\AuthController@signIn');
Route::get('/logout','User\AuthController@logout');

// Event section
Route::get('events','User\EventController@viewEvent')->name('frontend_view_events');
Route::get('/create-event','User\EventController@viewCreateEvent')->name('frontend_create_event');
Route::post('/save-events','User\EventController@saveEvent');
Route::get('/fetch_country','User\EventController@fetchCountry');
Route::get('/get_longitude_latitude','User\EventController@getLongitudeLatitude');
Route::get('/moreevent','User\EventController@getMoreEvent')->name('frontend_more_event');

// business section
Route::get('/business','User\BusinessController@viewBusiness')->name('frontend_view_business');
Route::get('/create-business','User\BusinessController@viewCreateBusiness')->name('frontend_create_business');
Route::post('/save-business','User\BusinessController@saveBusiness');
Route::get('/fetch_country_business','User\BusinessController@fetchCountry');
Route::get('/get_longitude_latitude_business','User\BusinessController@getLongitudeLatitude');
Route::get('/morebusiness','User\BusinessController@getMoreBusiness')->name('frontend_more_business');

// Shared Location section
Route::get('/location','User\SharedLocationController@index')->name('frontend_shared_location');

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

	Route::get('/my-favourite',function(){
		return view('frontend.pages.myfavourite');
	})->name('frontend_my_faourite');

	Route::get('/shared-location-more',function(){
		return view('frontend.pages.shared-location-more');
	})->name('frontend_shared_location_more');

	Route::get('/shared-location-new',function(){
		return view('frontend.pages.shared-location-new');
	})->name('frontend_shared_location_new');

	Route::get('/acount-settings',function(){
		return view('frontend.pages.accountsetting');
	})->name('frontend_acount_settings');

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
Auth::routes();


// admin section
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/login','AuthController@login')->name('login');
	Route::get('dashboard','DashboardController@index')->name('admin_dashboard');

	Route::get('/category','CategoryController@index')->name('category_list');
	Route::get('/category/create','CategoryController@create')->name('create_category');
	Route::post('/category/save','CategoryController@store')->name('save_category');
	Route::get('/category/edit','CategoryController@edit')->name('edit_category_page');

	Route::get('/event','EventController@index')->name('event_list');
	Route::get('/event/create','EventController@create')->name('create_event');
	Route::post('/event/save','EventController@store')->name('save_event');
	Route::get('/event/edit','EventController@edit')->name('edit_event_page');
	Route::get('/event/fetch_country','EventController@getCity')->name('get_country');

	Route::get('/business','BusinessController@index')->name('business_list');
	Route::get('/business/create','BusinessController@create')->name('create_business');
	Route::post('/business/save','BusinessController@store')->name('save_business');
	Route::get('/business/edit','BusinessController@edit')->name('edit_business_page');
	Route::get('/business/fetch_country','BusinessController@getCity')->name('get_business_country');

	Route::get('/profile','ProfileController@index')->name('profile_list');
	Route::get('/profile/create','ProfileController@create')->name('create_profile');
	Route::post('/profile/save','ProfileController@store')->name('save_profile');
	Route::get('/profile/edit','ProfileController@edit')->name('edit_profile_page');

	Route::get('/tags','TagController@index')->name('tag_list');
	Route::get('/tags/create','TagController@create')->name('create_tag');
	Route::post('/tags/save','TagController@store')->name('save_tag');
});


Route::get('/home', 'HomeController@index')->name('home');
