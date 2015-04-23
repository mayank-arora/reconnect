<?php

class Degree extends \Eloquent {
	protected $fillable = [];	
	public function users(){
		return $this->hasMany('User');
	}
}