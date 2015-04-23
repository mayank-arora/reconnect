<?php

class DiscussionsController extends \BaseController {

	/**
	 * Display a listing of discussions
	 *
	 * @return Response
	 */
	public function index()
	{
		$discussions = Discussion::all();

		return View::make('discussions.index', compact('discussions'));
	}

	/**
	 * Show the form for creating a new discussion
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('discussions.create');
	}

	/**
	 * Store a newly created discussion in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Discussion::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['user_id'] = Auth::id();
		Discussion::create($data);
		return Redirect::route('discussions.index');
	}

	/**
	 * Display the specified discussion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$discussion = Discussion::findOrFail($id);

		return View::make('discussions.show', compact('discussion'));
	}

	/**
	 * Show the form for editing the specified discussion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$discussion = Discussion::find($id);

		return View::make('discussions.edit', compact('discussion'));
	}

	/**
	 * Update the specified discussion in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$discussion = Discussion::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Discussion::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$discussion->update($data);

		return Redirect::route('discussions.index');
	}

	/**
	 * Remove the specified discussion from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Discussion::destroy($id);

		return Redirect::route('discussions.index');
	}

}
