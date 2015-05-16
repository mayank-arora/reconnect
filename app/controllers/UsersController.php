<?php

class UsersController extends \BaseController {



	public function createNewProfileData()
	{
		// Structure of the profile data

		// array(data)
		//  {
		//  'key' => obj->type
		// 				->year
		// 				->description
		//  }
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

		$arr = array();
		$megaArr = array($arr, array('status' => 0), array('Tech Talks' => 0, 'Workshops' => 0, 'Project Assistance' => 0, 'Guidance' => 0));
		$megaArr = json_encode($megaArr);
		return $megaArr;
	}

	public function sendVerificationLink()
	{
		$email = Input::get('email');
		$rules = ['email' => 'required|exists:users'];
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->with('noVerifyEmail', Input::all());
		}
		// var_dump($email);
		$user = User::where('email', '=', $email)->first();
		$fname = $user->fname;
		$lname = $user->lname;
		// var_dump($user->fname);
		$token = $user->token;
		// var_dump($token);
		Mail::send('emails.auth.verify', array('token' => $token), function($message) use ($email, $fname, $lname)
		{
			$message->to($email)->subject('Verify your account for BMSITM Reconnect');
		});

		return Redirect::route('home.login')->with('success', Input::all());

	}
	public function resetPassword()
	{
		$email = Input::get('email');
		$rules = ['email' => 'required|exists:users'];
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->with('noForgotEmail', Input::all());
		}
		// var_dump($email);
		$user = User::where('email', '=', $email)->first();
		// var_dump($user->fname);
		$token = Str::random(50);
		$fname = $user->fname;
		$lname = $user->lname;
		$user->resetToken = $token;
		$user->save();

		Mail::send('emails.auth.reminder', array('token' => $token, 'fname' => $fname, 'lname' => $lname), function($message) use ($email)
		{
			$message->to($email)->subject('Reset password for your BMSITM Reconnect account');
		});

		return Redirect::route('home.login')->with('success', Input::all());
	}
	public function getForgottenUser($token)
	{
		$user = User::where('resetToken', '=', $token)->first();
		$id = $user->id;
		if(!$user){
			return Redirect::route('home.login');
		}
		else{
			return View::make('newpassword',compact('id'));
		}
	}

	public function setNewPassword($id)
	{
		$rules = ['password' => 'required', 'confirm' => 'required|same:password'];
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->with('invalid', Input::all());
		}
		$user = User::find($id);
		// var_dump($user->fname);
		$data = Input::all();
		// var_dump($data);
		$password = Hash::make($data['password']);
		$user->password = $password;
		$user->resetToken = null;
		$user->save();
		return Redirect::route('home.login');

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
		$data['profile_data'] = App::make('UsersController')->createNewProfileData();

		$email = $data['email'];
		$token = $data['token'];
		$fname = $data['fname'];
		$lname = $data['lname'];
		
		Mail::send('emails.auth.verify', array('token' => $token, 'fname' =>$fname, 'lname' => $lname), function($message) use ($email)
		{
			$message->to($email)->subject('Verify your account for BMSITM Reconnect');
		});
		
		User::create($data);

		return Redirect::route('home.login')->with('success', Input::all());
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
		
		return Redirect::route('feedback');
	}

	/**
	 * Uploading the profile picture
	 */
	public function updatePicture($id){
		$user = User::findOrFail($id);
		// var_dump($user->id);
		$file= array('image'=>Input::file('image'));
		// var_dump($file);
		$rules = array('image' => 'required|image');
		$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else{
			if (Input::file('image')->isValid()){
				$dest = public_path().'/uploads';
				// var_dump('destination set as '.$dest);
				if($user->picture!= NULL){
					$fileName = $user->picture;
					// var_dump('existing filename - '.$fileName);
				}
				else{
					$extension = Input::file('image')->getClientOriginalExtension();
					$fileName = $user->email.Str::random(8).'.'.$extension;
					// var_dump('new file - '.$fileName);
				}
				Input::file('image')->move($dest, $fileName);
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
				$user->picture = $fileName;
				$user->save();
				return Redirect::route('users.edit', $user->id);
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
		return View::make('users.batch', compact('batch', 'id'));
	}

	/**
	 * Displaying the users based on their domain
	 */
	public function domainUser($id)
	{
		$domain = Domain::findOrFail($id);
		return View::make('users.domain', compact('domain'));
	}
	public function addProfileData($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::all();
		// var_dump($data);
		$validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$node = new stdClass;
		$node->type = $input['type'];
		$node->year = $input['year'];
		$node->description = $input['description'];
		// var_dump($node);
		$data[0][] = $node;
		// var_dump($data);
		// $node = array($node);
		// var_dump($node);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
	// public function editProfileData($entry)
	// {
	// 	// $user = Auth::user();
	// 	// $data = json_decode($user->profile_data);
	// 	// $input = Input::all();
	// 	// $validator = Validator::make($input, array('year' => 'required|numeric', 'description' => 'required'));
	// 	// if ($validator->fails()){
	// 	// 	return Redirect::back()->withErrors($validator)->withInput();
	// 	// }
	// }
	public function deleteProfileData($key)
	{
		$user = Auth::user();
		// var_dump($user->profile_data);
		$data = json_decode($user->profile_data);
		// var_dump($data);
		// foreach($data[0] as $index => $value){
		// 	if($index == $key){
		// 		$victim = $value;
		// 		var_dump($victim);
		// 		unset($data[0][$index]);
		// 	}
		// }
		unset($data[0][$key]);
		$data[0] =array_values($data[0]);
		// var_dump($data);
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
	public function addContactForData($id)
	{
		$user = User::find($id);
		$data = json_decode($user->profile_data);
		$input = Input::get('checklist');
		// var_dump($data);
		// var_dump($input);

		foreach($data[2] as $role => $status){
			$data[2]->$role= 0;
			foreach ($input as $value){
				if($role == $value){
					$data[2]->$role = 1;
				}
			}
		}
		// var_dump($data);
		$user->profile_data = json_encode($data);
		$user->save();
		return Redirect::route('users.show', $user->id);
	}
}