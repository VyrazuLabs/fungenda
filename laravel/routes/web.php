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
});

Route::post('/user_registration','User\AuthController@userRegistration');
Route::post('/login','User\AuthController@signIn');
Route::get('/logout','User\AuthController@logout');

// Event section
Route::get('view-events','User\EventController@viewEvent')->name('frontend_view_events');
Route::get('/create-event','User\EventController@viewCreateEvent')->name('frontend_create_event');
Route::post('/save-events','User\EventController@saveEvent');
Route::get('/fetch_country','User\EventController@fetchCountry');
Route::get('/get_longitude_latitude','User\EventController@getLongitudeLatitude');
Route::get('/moreevent','User\EventController@getMoreEvent')->name('frontend_more_event');

// business section
Route::get('/view-business','User\BusinessController@viewBusiness')->name('frontend_view_business');
Route::get('/create-business','User\BusinessController@viewCreateBusiness')->name('frontend_create_business');
Route::post('/save-business','User\BusinessController@saveBusiness');
Route::get('/fetch_country_business','User\BusinessController@fetchCountry');
Route::get('/get_longitude_latitude_business','User\BusinessController@getLongitudeLatitude');
Route::get('/morebusiness','User\BusinessController@getMoreBusiness')->name('frontend_more_business');

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
	Route::get('dashboard','AdminController@viewAdminPannel')->name('admin_dashboard');
	Route::get('category','AdminController@getCategory')->name('category_list');
	Route::post('category/save','AdminController@saveCategory')->name('save_category');
});


Route::get('/home', 'HomeController@index')->name('home');
