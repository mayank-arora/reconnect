<?php

class Profession extends \Eloquent {
	protected $fillable = [];
	public function users(){
		return $this->hasMany('User');
	}
}