<?php
	use Carbon\Carbon;
	$sender = new stdClass;
	$sender->sender_id = '1';
	$messages = new stdClass;
	$messages->text = 'Random message';
	$messages->way = 'in';
	$messages->time = Carbon::now();
	$sender->messages= array($messages, $messages);
	var_dump($sender);
	$file = array($sender);
	var_dump($file);
	//$file= json_encode($file);
	//var_dump($file);
	?>
	@foreach($file as $message)
	{{var_dump($message)}}
	@endforeach