<?php

class Post extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'text_content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['type', 'title', 'has_comment', 'text_content', 'user_id'];

	public function user(){
		return $this->belongsTo("User");
	}

	public function comments(){
		return $this->hasMany("Comment");
	}

}