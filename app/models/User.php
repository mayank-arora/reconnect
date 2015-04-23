<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $guarded = array('id', 'remember_token', 'confirm');

	public static $updaterules=[
	'location_id' => 'required'];

	public static $rules= [
	'email' => 'required|unique:users',
	'fname' => 'required',
	'lname' => 'required',
	'password' => 'required',
	'confirm' => 'same:password'
	];
	public function domains(){
		return $this->belongsToMany('Domain');
	}
	public function jobs(){
		return $this->belongsToMany('Job');
	}
	public function profession(){
		return $this->belongsTo('Profession');
	}
	public function message(){
		return $this->belongsTo('Message');
	}
	public function company(){
		return $this->belongsTo('Company');
	}
	public function branch(){
		return $this->belongsTo('Branch');
	}
	public function batch(){
		return $this->belongsTo('Batch');
	}
	public function degree(){
		return $this->belongsTo('Degree');
	}

	public function posts(){
		return $this->hasMany('Post');
	}

	public function comments(){
		return $this->hasMany("Comment");
	}

	public function events(){
		return $this->hasMany("Event");
	}
	public function discussions(){
		return $this->hasMany("Discussion");
	}
	public function replies(){
		return $this->hasMany("Reply");
	}
	public function location(){
		return $this->belongsTo("Location");
	}


	

}
