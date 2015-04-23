<?php

class Message extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'text' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['user_id', 'link'];
	public function user(){
		return $this->hasOne('User');
	}

}