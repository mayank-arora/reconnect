<?php

class RepliesController extends \BaseController {

	/**
	 * Display a listing of replies
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		
		return View::make('replies.index', compact('user'));
	}

	/**
	 * Show the form for creating a new reply
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('replies.create');
	}

	/**
	 * Store a newly created reply in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Reply::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['user_id'] = Auth::id();

		Reply::create($data);

		return Redirect::route('discussions.show', array($data['discussion_id']));
	}

	/**
	 * Display the specified reply.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$reply = Reply::findOrFail($id);

		return View::make('replies.show', compact('reply'));
	}

	/**
	 * Show the form for editing the specified reply.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reply = Reply::find($id);

		return View::make('replies.edit', compact('reply'));
	}

	/**
	 * Update the specified reply in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$reply = Reply::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Reply::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$reply->update($data);

		return Redirect::route('replies.index');
	}

	/**
	 * Remove the specified reply from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Reply::destroy($id);

		return Redirect::route('replies.index');
	}

}
