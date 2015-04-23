<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@showLogin' , 'as' => 'home.login'));
Route::get('login', array('uses' => 'HomeController@showLogin' , 'as' => 'home.art.login'));
Route::post('login', array('uses' => 'HomeController@attemptLogin', 'as' => 'users.login'));
Route::get('logout', array('uses' => 'HomeController@logout', 'as' => 'users.logout'));
Route::post('users', array('uses' => 'UsersController@store', 'as' => 'users.store'));


Route::group(array('before' => 'auth'), function(){
	Route::resource('posts', 'PostsController');
	Route::resource('comments','CommentsController');
	Route::resource('events','EventsController');
	Route::resource('discussions','DiscussionsController');
	Route::resource('replies', 'RepliesController');
	Route::resource('message', 'MessagesController');

	Route::post('updateProfilePicture/{id}', array('uses' => 'UsersController@updatePicture', 'as' => 'user.updatePicture'));
	Route::get('users/location/{id}', array('uses' => 'UsersController@locationUser', 'as' => 'users.location'));
	Route::get('users/batch/{id}', array('uses' => 'UsersController@batchUser', 'as' => 'users.batch'));
	Route::get('users/profession/{id}', array('uses' => 'UsersController@professionUser', 'as' => 'users.profession'));
	Route::get('users/domain/{id}', array('uses' => 'UsersController@domainUser', 'as' => 'users.domain'));
	Route::resource('users','UsersController', array('except' => array('store', 'create')));

	Route::get('jobs/apply/{id}', array('uses' => 'JobsController@apply', 'as' => 'jobs.apply'));
	Route::get('jobs/company/{id}', array('uses' => 'JobsController@companyJob', 'as' => 'company.jobs'));
	Route::get('jobs/location/{id}', array('uses' => 'JobsController@locationJob', 'as' => 'location.jobs'));
	Route::resource('jobs', 'JobsController');
	
	Route::get('home', array('uses' => 'HomeController@showHome', 'as' => 'home'));
	Route::get('events', array('uses' => 'HomeController@showEvent', 'as' => 'events'));
	Route::get('search', array('uses' => 'HomeController@showSearch', 'as' => 'search'));
	Route::get('discussion', array('uses' => 'HomeController@showDiscussion', 'as' => 'discussion'));
	Route::get('settings', array('uses' => 'HomeController@showSettings', 'as' => 'settings'));
	

});
