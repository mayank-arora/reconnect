<?php

class MessagesController extends \BaseController {

	/**
	 * Display a listing of messages
	 * @param User ID
	 * @return Message file object
	 */
	public function getOrCreateMessageFile($message){
		
		if($message->link==null){
			$url = Str::random(20);
			$file= array();
			$file= json_encode($file);
			File::put('messages/'.$url.'.txt',$file);
			$message->link = $url.'.txt';
			$message->save();
		}
		$file = File::get('messages/'.$message->link);
		$file = json_decode($file);
		return $file;

	}

	/**
	 * @param File object, Sender ID
	 * @return 
	 */
	public function getOrCreateSender($file,$id,$message){

		$flag=0;
		foreach ($file as $sender) {
			if($sender->sender_id == $id){
				$recipient_messages = $sender;
				$flag=1;
			}
		}

		if($flag==0){
			$new_sender=new stdClass;
			$new_sender->sender_id = $id;
			$new_sender->messages= array();
			array_push($file, $new_sender);
			$recipient_messages = $new_sender;
			$file = json_encode($file);
		 	File::put('messages/'.$message->link, $file);
		}
		return $recipient_messages;

	}
	public function index()
	{
		$user_id = Auth::id();
		$message = Message::firstOrNew(array('user_id' => $user_id));
		// var_dump($message);

		$file = App::make('MessagesController')->getOrCreateMessageFile($message);
		// var_dump($file);
		return View::make('messages.index', compact('file', 'message'));
	}

	/**
	 * Show the form for creating a new message
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('messages.create');
	}

	/**
	 * Store a newly created message in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Message::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$recipient = User::findOrFail($data['id']);
		$user_id= Auth::id();

		//Getting the user's file
		$message = Message::where('user_id', '=', $user_id)->firstOrFail();
		$file = File::get('messages/'.$message->link);
		$file = json_decode($file);

		//Setting a new message node
		$new_message = new stdClass;
		$new_message->text = $data['text'];
		$new_message->way = 'out';
		$date = new Datetime();
		$new_message->time = $date->format('Y-m-d H:i:s');

		//Finding the recipient's node in the file and inserting the message node
		foreach ($file as $sender) {
			if($sender->sender_id == $recipient->id){
				array_push($sender->messages, $new_message);
			}
		}

		//Saving the file
		$file = json_encode($file);
		File::put('messages/'.$message->link, $file);

		//Doing the same thing for the recipient's file
		$user_id = $recipient->id;
		$recipient = Auth::user();

		//Getting or creating the recipient's file
		$message = Message::firstOrNew(array('user_id' => $user_id));
		$file = App::make('MessagesController')->getOrCreateMessageFile($message);
		
		//Creating a new sender node if not present
		$recipient_messages = App::make('MessagesController')->getOrCreateSender($file,$recipient->id,$message);

		//Getting the file
		$file = File::get('messages/'.$message->link);
		$file = json_decode($file);

		//Creating new message node
		$new_message = new stdClass;
		$new_message->text = $data['text'];
		$new_message->way = 'in';
		$date = new Datetime();
		$new_message->time = $date->format('Y-m-d H:i:s');

		//Finding the recipient's node in the file and inserting the message node
		foreach ($file as $sender) {
			if($sender->sender_id == $recipient->id){
				array_push($sender->messages, $new_message);
			}
		}

		//Saving the file
		$file = json_encode($file);
		File::put('messages/'.$message->link, $file);

		return Redirect::back();
	}

	/**
	 * Display the specified message.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user= User::findOrFail($id);
		$user_id = Auth::id();
		$message = Message::firstOrNew(array('user_id' => $user_id));

		//Creating a new file if not present
		$file = App::make('MessagesController')->getOrCreateMessageFile($message);

		//Getting the recipient's node from the file
		$recipient_messages = App::make('MessagesController')->getOrCreateSender($file,$id,$message);
		
		return View::make('messages.show', compact('file','user', 'recipient_messages'));
	}
}
