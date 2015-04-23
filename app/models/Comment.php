<?php

class Comment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'text_content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['user_id' , 'post_id', 'text_content'];

	public function user(){
		return $this->belongsTo("User");
	}

	public function post(){
		return $this->belongsTo("Post");
	}

}