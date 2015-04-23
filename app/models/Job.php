<?php

class Job extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'designation' => 'required',
		'company_id' => 'required',
		'location_id' => 'required',
		'min_xp' => 'required|numeric',
		'max_xp' => 'required|numeric',
		'description' => 'required',
		'eligibility' => 'required',
		'requirements' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['designation', 'company_id',
	'location_id', 'min_xp', 'max_xp', 'description',
	'eligibility', 'requirements', 'link', 'referee_id', 'status'];
	public function users(){
		return $this->belongsToMany('User');
	}
	public function company(){
		return $this->belongsTo('Company');
	}
	public function location(){
		return $this->belongsTo('Location');
	}

}