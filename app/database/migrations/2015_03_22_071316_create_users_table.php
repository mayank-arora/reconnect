<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fname');
			$table->string('lname');
			$table->string('email');
			$table->string('password');
			$table->integer('batch');
			$table->string('branch');
			$table->string('location_id');
			$table->string('picture');
			$table->string('mobile');
			$table->date('dob');
			$table->string('usn');
			$table->rememberToken();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
