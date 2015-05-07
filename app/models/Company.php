<?php

class Company extends \Eloquent {
	protected $fillable = ['name'];
	public function users(){
		return $this->hasMany('User');
	}
	public function jobs(){
		return $this->hasMany('Job');
	}
}