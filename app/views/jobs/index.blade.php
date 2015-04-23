@extends('layouts.boilerplate')

@section('title')
<title>Jobs </title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<ul class="nav nav-tabs">
		<li id="job-jobs-tab" role="presentation" class="active"><a class="jobs-tab">All Jobs</a></li>
		<li id="job-company-tab" role="presentation"><a class="company-tab">Companies</a></li>
		<li id="job-job-location-tab" role="presentation"><a class="job-location-tab">Locations</a></li>
		<li id="job-applied-tab" role="presentation"><a class="applied-tab">My Jobs</a></li>
	</ul>
	<div class="jobs-container">
		<div class="gap"></div>
		<div class="col-md-2 hud flex">
			<a href="{{URL::route('jobs.create')}}"><span class="link-setter"></span></a>
			<div class="aligner"><span class="fa fa-edit"></span> </div>
		</div>
		@foreach($jobs as $job)
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
	<div class="company-container hide">
		<div class="gap"></div>
		@foreach($companies as $company)
		@include('partials._company-hud')
		@endforeach
	</div>
	<div class="job-location-container hide">
		<div class="gap"></div>
		@foreach($locations as $location)
		@include('partials._job-location-hud')
		@endforeach
	</div>
	<div class="applied-container hide">
		<div class="gap"></div>
		<h3>Jobs Applied For</h3>
		<div class="gap"></div>
		<div class="row">
			@foreach($user->jobs as $job)
			@include('partials._applied-hud')
			@endforeach
		</div>
			<h3>Jobs Posted</h3>
		<div class="row">
		<div class="gap"></div>
		@foreach($jobs as $job)
		@if($job->referee_id == Auth::id())
		@include('partials._myjob-hud')
		@endif
		@endforeach
		</div>
	</div>
</div>
@overwrite