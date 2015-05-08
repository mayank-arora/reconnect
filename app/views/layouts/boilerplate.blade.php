<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{{HTML::style('css/bootstrap.min.css')}}
	{{HTML::style('font-awesome/css/font-awesome.min.css')}}
	{{HTML::style('css/custom.css')}}
	{{HTML::style('css/bootstrap-select.min.css')}}

	{{HTML::style('css/animate.css')}}

	{{HTML::script('js/jq.js')}}
	{{HTML::script('js/bootstrap-select.min.js')}}
	{{HTML::script('js/custom.js')}}
	{{HTML::script('js/bootstrap.min.js')}}
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	@yield('title')
</head>
<body onload="initialize()">
	@yield('navbar')
	@yield('body')
</div>
</body>