@extends('layouts.boilerplate')

@section('title')
<title>Events</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="col-md-8">
		<div class="white-container">
			<h4>Event</h4>
			<p>{{$event->title}}</p>
			<hr>
			<br>
			<h4>Date and time</h4>
			<p>{{$event->date}}</p>
			<hr>
			<br>
			<h4>Description</h4>
			<p>{{$event->detail}}</p>
			<hr>
			<br>
			<h4>Location</h4>
			<p>{{$event->location}}</p><br><br>
			@if($creator->id == Auth::id())
			<a href="{{URL::route('events.join', Auth::id())}}" class="btn btn-primary col-md-2">Join</a>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="white-container">
			<h2>Created by</h2>
			<p><a href="{{URL::route('users.show', $creator->id)}}">{{$creator->fname}} {{$creator->lname}}</a></p>
		</div>
	</div>

</div>
@overwrite