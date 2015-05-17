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
		<form action="{{URL::route('events.store')}}" class="form-horizontal" method="post">
			<div class="form-group">
				<label for="title" class="col-md-3 control-label">Name of the event</label>
				<div class="col-md-6">
					<input type="text" name="title"class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="date" class="col-md-3 control-label">Date</label>
				<div class="col-md-3">
					<input type="text" name="date"class="form-control datepicker">
				</div>
			</div>
			<div class="form-group">
				<label for="time" class="col-md-3 control-label">Time</label>
				<div class="col-md-3">
					<input type="text" name="time"class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="location" class="col-md-3 control-label">Location</label>
				<div class="col-md-4">
					<input type="text" name="location"class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="detail" class="col-md-3 control-label">Details (If any)</label>
				<div class="col-md-6">
					<textarea style="resize:none;" name="detail" rows="10" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-2 col-md-offset-3">
					<input type="submit" class="btn btn-primary form-control" value="Post" >
				</div>
			</div>

		</div>
	</div>
</div>
@overwrite