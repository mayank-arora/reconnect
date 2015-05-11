<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{{HTML::style('css/bootstrap.min.css')}}
	{{HTML::style('font-awesome/css/font-awesome.min.css')}}
	{{HTML::style('css/custom-3.css')}}
	{{HTML::style('css/bootstrap-select.min.css')}}
	{{HTML::style('css/bootstrap-datepicker3.standalone.min.css')}}

	{{HTML::style('css/animate.css')}}

	{{HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js')}}
	{{HTML::script('js/bootstrap-select.min.js')}}
	{{HTML::script('js/bootstrap-datepicker.min.js')}}
	{{HTML::script('js/custom.js')}}
	{{HTML::script('js/bootstrap.min.js')}}
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<title>Set New Password</title>
</head>
<body onload="initialize()">
	<div class="container-fluid" style="padding:0;">
	<div class="col-md-6 login-logo-div">
		<div class="login-logo">
			{{ HTML::image('img/bmsit.png', 'BMSIT-logo', array( 'width' => '250px')) }}
		</div>
	</div>
	<div class="col-md-6 new-password-form-div">
		<div class="new-password-form animated fadeInLeft">
			{{Form::open(array('action' => array('UsersController@setNewPassword', $id) , 'method' => 'post'))}}
			
			<input class="login-form-input" type="password" name="password" placeholder="New Password"><br>
			<span class="login-error-text">
				@if(Session::get('invalid'))
				{{'Invalid passwords.'}}
				@endif
			</span><br>

			<input class="login-form-input" type="password" name="confirm" placeholder="Confirm Password"><br><br>

			<input class="login-form-button" type="submit" value="Change"  style="width:300px;">

			{{Form::close()}}
		</div>
	</div>
	<div class="login-title-div hidden-xs hidden-sm">
		<a href="{{URL::route('home.login')}}" style="text-decoration:none;"><h1><span id="login-reco">Reco<span><span id="login-nect">nnect</span></h1></a>
	</div>
</div>
</body>
