@extends('layouts.boilerplate')

@section('title')
<title>Jobs </title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="col-md-8">
		<div class="white-container">
			<h2>{{$job->designation}}</h2>
			<hr>
			<h4>Company</h4>
			<p>{{$job->company->name}}</p>
			<br>
			<h4>Location</h4>
			<p>{{$job->location->location}} </p>
			<br>
			<h4>Experience</h4>
			<p>{{$job->min_xp}} - {{$job->max_xp}} years </p>
			<br>
			<h4>Job Description</h4>
			<p>{{$job->description}} </p>
			<br>
			<h4>Eligibility Criteria</h4>
			<p>{{$job->eligibility}} </p>
			<br>
			<h4>Skill Requirements</h4>
			<p>{{$job->requirements}} </p>
			<br>
			<h4>Website Link</h4>
			<p>{{$job->link}} </p>
			<br>
			<h4>Status</h4>
			<p>
				@if($job->status ==1)
				Active
				@else
				Closed
				@endif
			</p>
			<br>
			<hr>
			@if($referee->id != Auth::id())
			<a href="{{URL::route('jobs.apply', array($job->id))}}"><button class="btn btn-primary col-md-2">Apply</button></a>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="white-container">

			@if($job->referee_id == Auth::id())
			<p>
				@if($job->users->count() == 1)
				1 candidate has applied for this job.
				@else
				{{$job->users->count()}} candidates have applied for this job.
				@endif
			</p>

			<div class="gap"></div>

			@foreach($job->users as $user)
			<p><a href="{{URL::route('users.show', $user->id)}}">{{$user->fname}} {{$user->lname}}</a></p>
			@endforeach

			<div class="gap"></div>
			<button id="contact-all-button" class="btn btn-primary">Contact them</button>
			<form action="#" method="post" id="contact-form" class="hidden">
			<div class="gap"></div>
				<div class="form-group">
					<textarea name="message" cols="30" rows="10" class="form-control" style="resize:none;"></textarea>
				</div>
				<input type="submit" value="Send" class="btn btn-primary">
			</form>

			@else
			<h3>Posted By</h3>
			<a href="{{URL::route('users.show', $referee->id)}}">{{$referee->fname}} {{$referee->lname}}</a>
			@endif
		</div>
	</div>
</div>
@overwrite