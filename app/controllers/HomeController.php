<?php

class HomeController extends BaseController {

	public function showWelcome()
	{
		return View::make('hello');
	}
	public function showLogin()
	{
		if(Auth::check()){
			return Redirect::route('home');
		}
		return View::make('login');
	}
	public function attemptLogin()
	{
		$creds= Input::all();
		if( Auth::attempt(array('email' => Input::get('email') , 'password' => Input::get('password') )))
		{
			return Redirect::route('home');
		}
		else
		{
			return Redirect::to('/');
		}
	}
	public function logout(){
		Auth::logout();
		return Redirect::route('home.login');
	}
	public function showHome()
	{
		$posts=Post::orderby('id', 'desc')->get();
		return View::make('home', array('posts' => $posts));
	}
	public function showEvent()
	{
		$posts=Post::all();
		return View::make('home', array('posts' => $posts));
	}
	/**
	 * public function showCollege()
	*{}
	*	$locations=Location::all();
	*	return View::make('college', array('locations' => $locations));
	*}
	 */
	public function showSearch()
	{
		$locations=Location::has('users')->get();
		$professions = Profession::all();
		$domains = Domain::all();
		$batches=Batch::orderby('id', 'desc')->get();
		return View::make('search', array('locations' => $locations, 'batches' => $batches, 'professions' => $professions, 'domains' => $domains));
	}
	public function showDiscussion()
	{
		$posts=Post::all();
		return View::make('discussion', array('posts' => $posts));
	}
	public function showSettings()
	{
		return View::make('settings', array('posts' => $posts));
	}
}
