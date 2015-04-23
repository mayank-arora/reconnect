@extends('layouts.boilerplate')



@section('title')
<title>Login Page</title>
@stop



@section('body')
<div class="container">
	<div class="jumbotron">
		<div class="bmsit" style="align:center;">
			<div class="bmsit-alt" style="width:200px;margin-left:auto;margin-right:auto;">
		{{ HTML::image('img/bmsit.png', 'BMSIT-picture', array( 'width' => '200px')) }}
			</div>
		</div>
		<h1 class="text-center">Reconnect</h1>
	</div>
	<div class="row"  id="login-form">
		{{Form::open(array('action' => 'HomeController@attemptLogin',
		'class' => 'text-center form-inline', 
		'method' => 'post'))}}
		<div class="form-group">
			<input class="form-control" type="email" name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<input class="form-control"type="password" name="password" placeholder="Password">
		</div>
		<input class="btn btn-primary"type="submit" value="Login">
		<a id="new-btn" class ="btn btn-default" href="#">Register</a>
	{{Form::close()}}
</div>
<div id="register-form" class="col-md-6 col-md-offset-3 hide">
	{{Form::open(array('action' => 'UsersController@store',
		'method' => 'post'))}}
		<div class="form-group">
			<input type="text" class="form-control register-text-fname" name="fname" placeholder="First Name">
		</div>
		<div class="form-group">
			<input type="text" class="form-control register-text-lname" name="lname" placeholder="Last Name">
		</div>
		<div class="form-group">
			<input type="email" class="form-control register-text-email" name="email" placeholder="Email">
		</div>
		<div class="form-group">
			<input type="password" class="form-control register-text-pass" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<input type="password" class="form-control register-text-confirm" name="confirm" placeholder="Confirm Password">
		</div>
		<div class="form-group">
			<input type="submit" value="Register" id="reg-btn" class="btn btn-primary">		
		</div>
		{{Form::close()}}
	</div>
</div>
@stop