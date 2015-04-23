<?php

class UsersController extends \BaseController {

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$validator = Validator::make($data, User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['password'] = Hash::make($data['password']);

		User::create($data);

		return Redirect::route('home.login');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$curr_user_id=Auth::id();
		$professions = Profession::all();
		$batches = Batch::orderBy('id', 'desc')->get();
		$degrees = Degree::all();
		$domains = Domain::all();
		$user_domains = $user->domains->lists('id');
		$branches = Branch::all();
		$companies = Company::orderBy('name', 'asc')->get();
		if($curr_user_id == $id){
			return View::make('users.edit', compact('user' , 'professions','degrees', 'batches', 'domains', 'branches', 'user_domains', 'companies'));
		}
		else{
			return Redirect::route('users.show' , array($id));
		}
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$updaterules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		/**
		 * Getting the location from the Google Maps API and storing in the locations table if not present already.
		 */

		$location = App::make('LocationsController')->getLocation($data['location_id']);
		$loc_id = App::make('LocationsController')->getLocationId($location);
		$data['location_id'] = $loc_id;

		if(isset($data['domain'])){
			$domains = $data['domain'];
			unset($data['domain']);
			$user->domains()->sync($domains);
			//var_dump($domains);
		}

		$user->update($data);
		//var_dump($data);
		
		return Redirect::route('users.show' , array($id));
	}

	/**
	 * Uploading the profile picture
	 */
	public function updatePicture($id){
		$user = User::findOrFail($id);
		$file= array('image'=>Input::file('image'));
		$rules = array('image' => 'required');
		$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else{
			if (Input::file('image')->isValid()){
				$dest = public_path().'/uploads';
				if($user->picture!= NULL){
					$fileName = $user->picture;
				}
				else{
					$extension = Input::file('image')->getClientOriginalExtension();
					$fileName = $user->email.Str::random(8).'.'.$extension;
				}
				Input::file('image')->move($dest, $fileName);
				$user->picture = $fileName;
				$user->save();
				$url ='uploads/'.$fileName;
				$img = Image::make($url);
				$height = $img->height();
				$width = $img->width();
				if($height<$width){
					$img= $img->crop($height,$height);
				}
				else{
					$img= $img->crop($width,$width);
				}
				$img->save($url);
				return Redirect::back();
			}
		}
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::route('users.index');
	}

	/**
	 * Displaying the users based on their location
	 */
	public function locationUser($id)
	{
		$location = Location::findOrFail($id);
		return View::make('users.location', compact('location'));
	}

	/**
	 * Displaying the users based on their profession
	 */
	public function professionUser($id)
	{
		$profession = Profession::findOrFail($id);
		return View::make('users.profession', compact('profession'));
	}

	/**
	 * Displaying the users based on their batch
	 */
	public function batchUser($id)
	{
		$batch = Batch::findOrFail($id);
		return View::make('users.batch', compact('batch'));
	}

	/**
	 * Displaying the users based on their domain
	 */
	public function domainUser($id)
	{
		$domain = Domain::findOrFail($id);
		return View::make('users.domain', compact('domain'));
	}
}