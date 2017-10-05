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
// Route::get('test',function(){
// 	return view('frontend.pages.create-sharelocation');
// });

Route::group(['namespace' => 'Frontend'],function(){
	Route::get('/','frontendController@index')->name('fronted_home');
	Route::get('/category','frontendController@getCategory')->name('frontend_category');
	Route::post('/search','SearchController@search')->name('frontend_search');
	Route::post('/set-session','SearchController@session')->name('fronend_session');
});


	Route::post('/user_registration','User\AuthController@userRegistration');
	Route::post('/loginUser','User\AuthController@signIn');
	Route::get('/logout','User\AuthController@logout');

	Route::get('events','User\EventController@viewEvent')->name('frontend_view_events');
	Route::post('/event/i_am_attending','User\EventController@iAmAttending')->name('i_am_attending_event');
	Route::get('/event/edit/{id}','User\EventController@edit')->name('edit_event');
	Route::get('event/image/delete/{id}/{name}','User\EventController@deleteImage')->name('event_edit_image_delete');
	Route::post('/event/update','User\EventController@update')->name('user_event_update');


	Route::get('/business','User\BusinessController@viewBusiness')->name('frontend_view_business');
	Route::post('/business/i_am_attending','User\BusinessController@iAmAttending')->name('i_am_attending_business');
	Route::get('/business/edit/{id}','User\BusinessController@edit')->name('edit_business');
	Route::get('business/image/delete/{id}/{name}','User\BusinessController@deleteImage')->name('business_edit_image_delete');
	Route::post('/business/update','User\BusinessController@update')->name('user_business_update');

	//Shared location section
	Route::get('/location','User\SharedLocationController@index')->name('frontend_shared_location');
	Route::post('/location/search/searchfor','User\SharedLocationController@searchfor')->name('frontend_shared_location_search_searchfor');
	Route::post('/location/search/state','User\SharedLocationController@stateSearch')->name('frontend_shared_location_search_state');
	Route::post('/location/search/city','User\SharedLocationController@city')->name('frontend_shared_location_search_city');
	Route::get('/location/privately_saved','User\SharedLocationController@privatelySavedFetch')->name('frontend_shared_location_privately_saved');
	Route::get('/more_shared_location/{id}','User\SharedLocationController@moreSharedLocation')->name('frontend_more_shared_location');
	Route::post('/more_shared_location/add_to_favourite','User\SharedLocationController@addToFavorite')->name('add_to_favourite_shared_location');
	Route::post('/more_shared_location/remove_from_favorite','User\SharedLocationController@removeFromFavorite')->name('remove_to_favourite_shared_location');

Route::group(['middleware'=>'auth'],function(){
	// Event section
	
	Route::get('/create-event','User\EventController@viewCreateEvent')->name('frontend_create_event');
	Route::post('/save-events','User\EventController@saveEvent');
	Route::get('/fetch_country','User\EventController@fetchCountry');
	Route::get('/fetch_state','User\EventController@fetchState');
	Route::get('/get_longitude_latitude','User\EventController@getLongitudeLatitude');
	

	// business section
	
	Route::get('/create-business','User\BusinessController@viewCreateBusiness')->name('frontend_create_business');
	Route::post('/save-business','User\BusinessController@saveBusiness');
	Route::get('/fetch_country_business','User\BusinessController@fetchCountry');
	Route::get('/fetch_state_business','User\BusinessController@fetchState');
	Route::get('/get_longitude_latitude_business','User\BusinessController@getLongitudeLatitude');
	

	//My favorite section
	Route::get('/my-favourite','User\MyFavouriteController@viewMyFavourite')->name('frontend_my_faourite');
	Route::post('/my-favourite/search','User\MyFavouriteController@search')->name('frontend_my_favorite_search');

	//Profile section
	Route::get('/profile','User\ProfileController@viewProfilePage')->name('frontend_profile_page');
	Route::post('/profile/save','User\ProfileController@saveProfile')->name('frontend_profile_save');

	// Shared Location section
	Route::get('/share-your-location','User\SharedLocationController@shareLocationForm')->name('create_share_location');
	Route::post('/share-your-location/save','User\SharedLocationController@store')->name('create_share_location_save');

	//Account Settings
	Route::get('/account-settings','User\AccountSettingsController@view')->name('frontend_acount_settings');
	Route::post('/save-account-settings','User\AccountSettingsController@savePassword')->name('save_account_settings');
	Route::post('/save-account-settings-mail','User\AccountSettingsController@saveNotificationSettings')->name('save_notification');
	
});
	//More event
	Route::get('/moreevent','User\EventController@getMoreEvent')->name('frontend_more_event');
	//More business
	Route::get('/morebusiness','User\BusinessController@getMoreBusiness')->name('frontend_more_business');

	// Add to favorite
	Route::post('/add_to_favourite_business','User\BusinessController@addToFavourite')->name('add_to_favourite_business');
	Route::post('/remove_to_favourite_business','User\BusinessController@removeFavorite')->name('remove_to_favourite_business');
	Route::post('/add_to_favourite_event','User\EventController@addToFavourite')->name('add_to_favourite_event');
	Route::post('/remove_to_favourite_event','User\EventController@removeFavorite')->name('remove_to_favourite_event');

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

	Route::get('/shared-location-more',function(){
		return view('frontend.pages.shared-location-more');
	})->name('frontend_shared_location_more');

	Route::get('/shared-location-new',function(){
		return view('frontend.pages.shared-location-new');
	})->name('frontend_shared_location_new');

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
	Route::get('/login','AuthController@login')->name('login')->middleware('loginCheck');
	Route::post('/login','AuthController@checkLogin')->name('checkLogin');
	Route::group(['middleware'=>'checkAdmin'],function(){
		
		Route::get('dashboard','DashboardController@index')->name('admin_dashboard');

		Route::get('/category','CategoryController@index')->name('category_list');
		Route::get('/category/create','CategoryController@create')->name('create_category');
		Route::post('/category/save','CategoryController@store')->name('save_category');
		Route::get('/category/edit/{id}','CategoryController@edit')->name('edit_category_page');
		Route::post('/category/edit','CategoryController@update')->name('update_category');

		Route::get('/event','EventController@index')->name('event_list');
		Route::get('/event/create','EventController@create')->name('create_event');
		Route::post('/event/save','EventController@store')->name('save_event');
		Route::post('/event/update','EventController@update')->name('update_event');
		Route::get('event/image/delete/{id}/{name}','EventController@deleteImage')->name('admin_event_edit_image_delete');

		Route::get('/event/edit/{id}','EventController@edit')->name('edit_event_page');
		Route::get('/event/fetch_state','EventController@fetchState');
		Route::get('/event/fetch_country','EventController@getCity')->name('get_country');

		Route::get('/business','BusinessController@index')->name('business_list');
		Route::get('/business/create','BusinessController@create')->name('create_business');
		Route::post('/business/save','BusinessController@store')->name('save_business');
		Route::get('/business/edit/{id}','BusinessController@edit')->name('edit_business_page');
		Route::post('/business/update','BusinessController@update')->name('update_business');
		Route::get('business/image/delete/{id}/{name}','BusinessController@deleteImage')->name('admin_business_edit_image_delete');
		
		Route::get('/business/fetch_state','EventController@fetchState');
		Route::get('/business/fetch_country','BusinessController@getCity')->name('get_business_country');

		Route::get('/profile','ProfileController@index')->name('profile_list');
		Route::get('/profile/create','ProfileController@create')->name('create_profile');
		Route::post('/profile/save','ProfileController@store')->name('save_profile');
		Route::get('/profile/edit/{id}','ProfileController@edit')->name('edit_profile_page');
		Route::post('/profile/update','ProfileController@update')->name('update_profile');

		Route::get('/tags','TagController@index')->name('tag_list');
		Route::get('/tags/create','TagController@create')->name('create_tag');
		Route::post('/tags/save','TagController@store')->name('save_tag');
		Route::get('/tag/edit','TagController@edit')->name('edit_tag_page');
		Route::post('/tag/edit','TagController@update')->name('update_tag');
		Route::get('/tag/delete','TagController@destroy')->name('delete_tag');

		// Admin logout
		Route::get('/logout','AuthController@adminLogout');

	});
});

Route::get('/home', 'HomeController@index')->name('home');

