@extends('layouts.boilerplate')

@section('title')
<title>Search</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<h3>{{$location->location}}</h3>
	<div class="gap"></div>
	@foreach($location->users as $user)
	@include('partials._user-detail-hud')
	@endforeach
</div>
@overwrite