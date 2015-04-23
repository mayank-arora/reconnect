@extends('layouts.boilerplate')

@section('title')
<title>Post a new job </title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script>
function initialize(){
	autocomplete = new google.maps.places.Autocomplete((document.getElementById('map-autocomplete')),
		{types:['(regions)']});
	google.maps.event.addListener(autocomplete, 'place changed', function(){
		fillLcoation()
	});
}
function fillLocation(){
	var place = autocomplete.getPlace();
	}
	</script>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="col-md-8">
		<form action="{{URL::route('jobs.store')}}" class="form-horizontal" method="post">
			<div class="form-group">
				<label for="designation" class="col-md-3 control-label">Designation</label>
				<div class="col-md-6">
					<input type="text" name="designation"class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="company_id" class="col-md-3 control-label">Company</label>
				<div class="col-md-4">
					<select name="company_id" id="company" class="form-control selectpicker" data-live-search="true">
						@foreach($companies as $company)
						{{ '<option value="'.$company->id.'">'.$company->name.'</option>'}}
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				{{Form::label('location_id' , 'Location' , array('class' => 'control-label col-md-3'))}}
				<div class="col-md-5">
					<input type="text" name="location_id" class="form-control" id="map-autocomplete">
				</div>
			</div>
			<div class="form-group">
				<label for="min_xp" class="col-md-3 control-label">Minimum Experience</label>
				<div class="col-md-2">
					<input type="text" name="min_xp" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="max_xp" class="col-md-3 control-label">Maximum Experience</label>
				<div class="col-md-2">
					<input type="text" name="max_xp" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-md-3 control-label">Job Description</label>
				<div class="col-md-8">
					<textarea style="resize:none;" name="description" rows="10" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="eligibility" class="col-md-3 control-label">Eligibility Criteria</label>
				<div class="col-md-8">
					<textarea style="resize:none;" name="eligibility" rows="6" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="requirements" class="col-md-3 control-label">Skill Requirements</label>
				<div class="col-md-8">
					<textarea style="resize:none;" name="requirements" rows="6" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="link" class="col-md-3 control-label">Link <small>( If any )</small></label>
				<div class="col-md-8">
					<input type="text" name="link" class="form-control">
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label for="random" class="col-md-3 control-label"></label>
				<div class="col-md-8">
				<button class="btn btn-primary col-md-3 col-md-offset-9" type="submit">Post</button>
				</div>
			</div>
		</form>
	</div>
</div>
@overwrite