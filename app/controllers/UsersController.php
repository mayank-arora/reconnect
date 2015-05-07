<?php

class UsersController extends \BaseController {



	public function createNewProfileData()
	{
		// Structure of the profile data

		// array(data)
		// {
		// 	array(awards)
		// 	{
		// 		'year' => 'description'
		// 		.
		// 		.
		// 		.
		// 	}
		// 	array(roles)
		// 	{
		// 		'year' => 'description'
		// 		.
		// 		.
		// 		.
		// 	}
		// 	array(achievements)
		// 	{
		// 		'year' => 'description'
		// 		.
		// 		.
		// 		.
		// 	}
		// 	array(studies)
		// 	{
		// 		'year' => 'description'
		// 		.
		// 		.
		// 		.
		// 	}
		// 	array(CSRs)
		// 	{
		// 		'year' => 'description'
		// 		.
		// 		.
		// 		.
		// 	}
		// array(enterpreneur)
		//  {
		// 		'status' => 'value'
		//  }
		// 	array(help)
		// 	{
				// 'techTalk' => 'status'
				// 'workshop' => 'status'
				// 'projectAssistance' => 'status'
				// 'guidance' => 'status'
		// 	}	
		// }

		$obj = new stdClass;
		$arr = array();
		$megaArr = array($arr, $arr, $arr, $arr, $arr, array('status' => 0), array('Tech Talks' => 0, 'Workshops' => 0, 'Project Assistance' => 0, 'Guidance' => 0));
		$megaArr = json_encode($megaArr);
		return $megaArr;
	}

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
		$data['status'] = 0;
		$data['token'] = Str::random(50);
		$email = $data['email'];
		$token = $data['token'];
		$data['profile_data'] = App::make('UsersController')->createNewProfileData();

		Mail::send('emails.auth.verify', array('token' => $token), function($message) use ($email)
		{
			$message->to($email)->subject('Verify your account for BMSITM Reconnect');
		});
		User::create($data);

		return Redirect::route('home.login')->with('success', Input::all());
	}

	/**
	 * Verify a user's auth token and activate the account
	 */
	public function verify($token)
	{
		$user = User::where('token', '=', $token)->first();
		// var_dump($user);
		if(!$user)
		{
			return Redirect::route('home.login');
		}
		else
		{
			$user->status = 1;
			$user->token = NULL;
			$user->save();
			return Redirect::route('home.login');
		}
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
		$profile_data = json_decode($user->profile_data);
		return View::make('users.show', compact('user', 'profile_data'));
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
		// var_dump($location->address_components);
		$location = App::make('LocationsController')->getCity($location);
		// var_dump($location);
		$location = App::make('LocationsController')->getLocation($location);
		// var_dump($location);
		$loc_id = App::make('LocationsController')->getLocationId($location);
		$data['location_id'] = $loc_id;
		// var_dump(Location::find($loc_id));

		$domains =array();
		if(isset($data['domain'])){
			$domains = $data['domain'];
			unset($data['domain']);
			$user->domains()->sync($domains);
		}
		// var_dump($domains);
		if($data['new_domain'] != '')
		{
			$domain = Domain::create(array('name' => $data['new_domain']));
			$domain =array($domain->id);
			// var_dump($domain);
			$domains = array_merge($domains, $domain);
			// var_dump($domains);
			$user->domains()->sync($domains);
			
		}
		if($data['new_company'] != '')
		{
			$company = Company::create(array('name' => $data['new_company']));
			$data['company_id'] = $company->id;
		}
		unset($data['new_company']);
		unset($data['new_domain']);

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
	public function addAward($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::all();
		$validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		// var_dump($input);
		// var_dump($data);
		// var_dump($data[0]);
		$node = new stdClass;
		$node->year = $input['year'];
		$node->description = $input['description'];
		// var_dump($node);
		$data[0][] = $node;
		// array_push($data[0], $input);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
	public function addRole($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::all();
		$validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		// var_dump($input);
		// var_dump($data);
		// var_dump($data[0]);
		$node = new stdClass;
		$node->year = $input['year'];
		$node->description = $input['description'];
		// var_dump($node);
		$data[1][] = $node;
		// array_push($data[0], $input);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
	public function addAchievement($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::all();
		$validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		// var_dump($input);
		// var_dump($data);
		// var_dump($data[0]);
		$node = new stdClass;
		$node->year = $input['year'];
		$node->description = $input['description'];
		// var_dump($node);
		$data[2][] = $node;
		// array_push($data[0], $input);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
	public function addStudy($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::all();
		$validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		// var_dump($input);
		// var_dump($data);
		// var_dump($data[0]);
		$node = new stdClass;
		$node->year = $input['year'];
		$node->description = $input['description'];
		// var_dump($node);
		$data[3][] = $node;
		// array_push($data[0], $input);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
	public function addCsr($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::all();
		$validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		// var_dump($input);
		// var_dump($data);
		// var_dump($data[0]);
		$node = new stdClass;
		$node->year = $input['year'];
		$node->description = $input['description'];
		// var_dump($node);
		$data[4][] = $node;
		// array_push($data[0], $input);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
}