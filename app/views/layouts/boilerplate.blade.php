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
	@yield('title')
</head>
<body onload="initialize()">
	<div id="terms-container">
		<div id="terms-header">
			@yield('navbar')

		</div>
		<div id="terms-body">
			@yield('body')	
		</div>
		<div id="terms-footer">
		<p class="terms-text">&copy; Reconnect 2015, <a href="http://mayankarora.in">Mayank Arora</a></p>
		<p class="license-text">
			This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">CC Attribution 4.0 License</a>.
		</p>
		</div>
	</div>
</body>