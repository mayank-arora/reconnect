<?php

class Reply extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'text_content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['text_content', 'discussion_id', 'reply_id', 'user_id'];

	public function user(){
		return $this->belongsTo("User");
	}
	public function discussion(){
		return $this->belongsTo("Discussion");
	}

}