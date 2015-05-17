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
			<p>{{$event->date}} {{$event->time}}</p>
			<hr>
			<br>
			<h4>Details</h4>
			<p>{{$event->detail}}</p>
			<hr>
			<br>
			<h4>Location</h4>
			<p>{{$event->location}}</p><br><br>
			@if($creator->id == Auth::id())
			<a href="{{URL::route('events.join', $event->id)}}" class="btn btn-primary col-md-2">Join</a>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="white-container">
			<h4>Created by</h4>
			<p><a href="{{URL::route('users.show', $creator->id)}}">{{$creator->fname}} {{$creator->lname}}</a></p>
			<br>
			<h4>People attending</h4>
			@foreach(json_decode($event->guest_list) as $guest)
			<?php
			$user = User::find($guest);
			?>
			<a href="{{URL::route('users.show', $user->id)}}">{{$user->fname}} {{$user->lname}}</a>
			@endforeach
		</div>
	</div>

</div>
@overwrite