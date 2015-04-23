<?php

class Location extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'location' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['location', 'city', 'state', 'country', 'latitude', 'longitude', 'place_id'];

	public function users(){
		return $this->hasMany("User");
	}
	public function jobs(){
		return $this->hasMany("Job");
	}
}