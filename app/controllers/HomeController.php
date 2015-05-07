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

		if($user = User::where('email', '=' , Input::get('email'))->first()){}
		else
		{
			return Redirect::back()->with('data',  Input::all());
		}

		if( Auth::attempt(array('email' => Input::get('email') , 'password' => Input::get('password'), 'status' => '1')))
		{
			return Redirect::intended('home');
		}
		elseif( $user->status == 0 )
		{
			return Redirect::back()->with('verify',  Input::all());
		}
		else
		{
			return Redirect::back()->with('data',  Input::all());
		}
	}
	public function logout(){
		Auth::logout();
		return Redirect::route('home.login');
	}
	public function showHome()
	{
		$user = Auth::user();
		if ($user->batch_id == 0) {
			return Redirect::route('users.edit', Auth::id());
		}
		else{	
		$posts=Post::orderby('id', 'desc')->get();
		return View::make('home', array('posts' => $posts));
		}
	}
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
