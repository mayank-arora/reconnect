<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{{HTML::style('css/bootstrap.min.css')}}
	{{HTML::style('font-awesome/css/font-awesome.min.css')}}
	{{HTML::style('css/custom-2.css')}}
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
	<title>Login</title>
	<?php
	$session = Session::all();
	?>
	@if(isset($session['_old_input']))
	<script>
	$(document).ready(function(){
		$(".login-form").addClass("hidden");
		$(".login-forgot-password").addClass("hidden");
		$(".login-register-form").removeClass("hidden").addClass("animated fadeIn");
	});
	</script>
	@endif

	@if(isset($session['data']))
	<script>
	$(document).ready(function(){
		$(".login-form").removeClass("fadeInLeft").addClass("fadeIn");
		$(".login-forgot-password").removeClass("animated");
		$("#login-email-input").val("{{$session['data']['email']}}")
	});
	</script>
	@endif

	@if(isset($session['verify']))
	<script>
	$(document).ready(function(){
		$(".login-form").removeClass("animated");
		$("#login-email-input").val("{{$session['verify']['email']}}")
		$(".login-forgot-password").addClass("hidden");
		$(".login-send-again").removeClass("hidden").addClass("animated fadeIn");
	});
	</script>
	@endif

	@if(isset($session['success']))
	<script>
	$(document).ready(function(){
		$(".login-form").addClass("hidden");
		$(".login-register-form").addClass("hidden");
		$(".login-forgot-password").addClass("hidden");
		$(".login-success-div").removeClass("hidden").addClass("animated fadeIn")
	});
	</script>
	@endif

	@if(isset($session['noVerifyEmail']))
	<script>
	$(document).ready(function(){
		$(".login-form").addClass("hidden");
		$(".login-forgot-password").addClass("hidden");
		$(".login-send-again-form").removeClass("hidden").addClass("animated fadeIn");
	});
	</script>
	@endif

	@if(isset($session['noForgotEmail']))
	<script>
	$(document).ready(function(){
		$(".login-form").addClass("hidden");
		$(".login-forgot-form").removeClass("hidden").addClass("animated fadeIn");
	});
	</script>
	@endif
</head>
<body onload="initialize()">

	<div class="container-fluid" style="padding:0;">
		<div class="col-md-6 login-logo-div">
			<div class="login-logo">
				{{ HTML::image('img/bmsit.png', 'BMSIT-logo', array( 'width' => '250px')) }}
			</div>
		</div>
		<div class="col-md-6 login-form-div">
			<div class="login-form animated fadeInLeft">

				{{Form::open(array('action' => 'HomeController@attemptLogin', 'method' => 'post'))}}

				<input class="login-form-input"type="email" name="email" placeholder="Email" id="login-email-input"><br>
				<span class="login-error-text">
					@if(isset($session['verify']))
					{{'The email address is not verified yet.'}}
					@endif
				</span><br>

				<input class="login-form-input"type="password" name="password" placeholder="Password"><br>
				<span class="login-error-text">
					@if(isset($session['data']))
					{{'The credentials don\'t match.'}}
					@endif
				</span><br>

				<input class="login-form-button"type="submit" value="Login">

				<input class="login-form-button"type="button" value="Register" id="register-init">

				{{Form::close()}}
			</div>

			<div class="login-register-form hidden">
				{{Form::open(array('action' => 'UsersController@store','method' => 'post'))}}

				<input type="text" value="{{Input::old('fname', '')}}" name="fname"  class="login-form-input" placeholder="First Name" id="login-fname-input"><br>
				<span class="login-error-text">
					<?php 
					$fname = $errors->first('fname');
					?>
					@if($fname!=NULL)
					{{'The first name field is required'}}
					@endif
				</span><br>

				<input type="text" value="{{Input::old('lname', '')}}" name="lname"  class="login-form-input" placeholder="Last Name"><br>
				<span class="login-error-text">
					<?php 
					$lname = $errors->first('lname');
					?>
					@if($lname!=NULL)
					{{'The last name field is required'}}
					@endif
				</span><br>

				<input type="email" value="{{Input::old('email', '')}}" name="email"  class="login-form-input" placeholder="Email"><br>
				<span class="login-error-text">{{$errors->first('email')}}</span><br>

				<input type="password" name="password"  class="login-form-input" placeholder="Password"><br>
				<span class="login-error-text">{{$errors->first('password')}}</span><br>

				<input type="password" name="confirm" class="login-form-input" placeholder="Confirm Password"><br>
				<span class="login-error-text">
					<?php 
					$confirm = $errors->first('confirm');
					?>
					@if($confirm!=NULL)
					{{'Both of the password fields should match'}}
					@endif
				</span><br>

				<input type="submit" class="login-form-button" value="Register" style="width:300px;">

				{{Form::close()}}
			</div>


			<button class="login-forgot-password animated fadeIn">Forgot Password?</button>
			<button class="login-send-again hidden">Send verification link?</button>


			<div class="login-forgot-form hidden">
				{{Form::open(array('route' => 'users.password.reset', 'method' => 'post'))}}
				<input type="email" name="email" class="login-form-input" placeholder="Email" id="forgot-form-email"><br>
				<span class="login-error-text">
					@if(isset($session['noForgotEmail']))
					{{'Enter a valid email address.'}}
					@endif
				</span><br>
				<input type="submit" class="login-form-button" value="Send" style="width:300px;">
				{{Form::close()}}
			</div>
			<div class="login-send-again-form hidden">
				{{Form::open(array('route' => 'users.sendlink', 'method' => 'post'))}}
				<input type="email" name="email" class="login-form-input" placeholder="Email" id="send-again-email"><br>
				<span class="login-error-text">
					@if(isset($session['noVerifyEmail']))
					{{'Enter a valid email address.'}}
					@endif
				</span><br>
				<input type="submit" class="login-form-button" value="Verify" style="width:300px;">
				{{Form::close()}}
			</div>
			<div class="login-success-div hidden">
				<p>A verification link has been sent to the given email address.</p>
			</div>
		</div>
		<div class="login-title-div hidden-xs hidden-sm">
			<a href="{{URL::route('home.login')}}" style="text-decoration:none;"><h1><span id="login-reco">Reco<span><span id="login-nect">nnect</span></h1></a>
		</div>
	</div>
</body>
</html>