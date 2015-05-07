@extends('layouts.boilerplate')

@section('title')
<title>Events</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="gap"></div>
	<div class="col-md-2 hud flex">
		<a href="{{URL::route('events.create')}}">
			<span class="link-setter"></span>
		</a>
		<div class="aligner">
			<span class="fa fa-edit"></span>
		</div>
	</div>
	@foreach($events as $event)
	<div class="col-md-2 hud">
		<a href="{{URL::route('event.show', $event->id)}}"><span class="link-setter"></span></a>
		<div style="text-align:center;">
			<h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$event->title}}</h3>
		</div>
		<small class="hud-user">{{$event->date}}</small>
		<small class="hud-date">{{$event->location}}</small>
	</div>
	@endforeach
</div>
@overwrite