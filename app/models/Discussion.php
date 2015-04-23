<?php

class Discussion extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'title' => 'required',
		 'text_content' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title' , 'text_content', 'user_id'];

	public function user(){
		return $this->belongsTo("User");
	}
	public function replies(){
		return $this->hasMany("Reply");
	}

}