@extends('layouts.boilerplate')

@section('title')
<title>Jobs </title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<h3>{{$location->location}}</h3>
	<div class="gap"></div>
	@foreach($location->jobs as $job)
		<div class="col-md-2 hud">
			@foreach($job->users as $this_user)
			@if($this_user->id == Auth::id())
			{{ HTML::image('img/applied-check.png','check', array('class' =>'applied-check'))}}
			@endif
			@endforeach
			<a href="{{URL::route('jobs.show', $job->id)}}"><span class="link-setter"></span></a>
			<div style="text-align:center;">
				<h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$job->designation}}</h3>
			</div>
			<small class="hud-user">{{$job->company->name}}</small>
			<small class="hud-date">{{$job->location->city}}</small>
		</div>
		@endforeach
</div>
@overwrite