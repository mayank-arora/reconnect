<?php

class JobsController extends \BaseController {

	/**
	 * Display a listing of jobs
	 *
	 * @return Response
	 */
	public function index()
	{
		$jobs = Job::where('status', '=', '1')->orderBy('id', 'desc')->get();
		$companies = Company::with('jobs')->get();
		$locations = Location::with('jobs')->get();
		$user = Auth::user();

		return View::make('jobs.index', compact('jobs', 'companies', 'locations', 'user'));
	}

	/**
	 * Show the form for creating a new job
	 *
	 * @return Response
	 */
	public function create()
	{
		$companies = Company::orderBy('name', 'asc')->get();
		return View::make('jobs.create', compact('companies'));
	}

	/**
	 * Store a newly created job in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Job::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['referee_id'] = Auth::id();

		$location = App::make('LocationsController')->getLocation($data['location_id']);
		$loc_id = App::make('LocationsController')->getLocationId($location);
		$data['location_id'] = $loc_id;
		$data['status'] = 1;
		//+d($data);
		Job::create($data);
		return Redirect::route('jobs.index');
	}

	/**
	 * Display the specified job.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$job = Job::findOrFail($id);
		$referee = User::findOrFail($job->referee_id);
		return View::make('jobs.show', compact('job', 'referee'));
	}

	/**
	 * Apply to a specified job.
	 */
	public function apply($id)
	{
		$job = Job::findOrFail($id);
		$user= Auth::user();
		$all_jobs = $user->jobs->lists('designation', 'id');
		$all_jobs = array_add($all_jobs, $job->id, $job->designation);
		$all_jobs = array_keys($all_jobs);
		
		
		//+d($all_jobs);
		$user->jobs()->sync($all_jobs);
		return Redirect::back();
	}
	/**
	 * Get jobs of a specified company
	 */
	public function companyJob($id)
	{
		$company = Company::findOrFail($id);
		return View::make('jobs.company', compact('company'));
	}
	/**
	 * Get jobs of a specified location
	 */
	public function locationJob($id)
	{
		$location = Location::findOrFail($id);
		
		return View::make('jobs.location',compact('location'));
	}

	/**
	 * Show the form for editing the specified job.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$job = Job::find($id);

		return View::make('jobs.edit', compact('job'));
	}

	/**
	 * Update the specified job in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$job = Job::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Job::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$job->update($data);

		return Redirect::route('jobs.index');
	}

	/**
	 * Remove the specified job from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Job::destroy($id);

		return Redirect::route('jobs.index');
	}
	public function sendMany($user_ids){

	}

}
