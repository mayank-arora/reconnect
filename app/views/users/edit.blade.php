@extends('layouts.boilerplate')


@section('title')
<title>{{$user->fname}} {{$user->lname}}</title>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
<script>
function initialize(){
	autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),
		{types:['(cities)']});
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
	<div class="col-md-4">
		@if($user->picture == NULL)
		{{ HTML::image('img/dp.png', 'profile-picture', array('class' => 'img-thumbnail' , 'width' => '60%')) }}
		@else
		{{ HTML::image('uploads/'.$user->picture.'?'.Str::random(10), 'profile-picture', array('class' => 'img-thumbnail' , 'width' => '60%')) }}
		@endif
		<hr>
		{{Form::open(array('route'=>array('user.updatePicture', $user->id), 'method'=>'Post' , 'files'=>true))}}
		{{Form::file('image')}}
		<hr>
		<input type="submit" value="Upload" class=" col-md-4 btn btn-primary">
	</form>
</div>
<div class="col-md-8">
	{{Form::model($user, array('route' => array('users.update' , $user->id) , 'method' =>'put' , 'class' => 'form-horizontal'))}}
	<div class="form-group">
		{{Form::label('fname' , 'First Name' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			{{Form::text('fname' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('lname' , 'Last Name' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			{{Form::text('lname' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('email' , 'Email Address' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-5">
			{{Form::text('email' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('batch_id' , 'Passing Batch' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			<select name="batch_id" id="batch" class="form-control selectpicker">
				@foreach($batches as $batch)
				@if($user->batch_id == $batch->id)
				{{'<option selected value="'.$batch->id.'">'.$batch->value.'</option>'}}
				@else
				{{'<option value="'.$batch->id.'">'.$batch->value.'</option>'}}
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group hidden" id="form-degree">
		{{Form::label('degree_id' , 'Degree' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			<select name="degree_id" id="degree" class="form-control selectpicker">
				@foreach($degrees as $degree)
				@if($user->degree_id == $degree->id)
				{{'<option selected value="'.$degree->id.'">'.$degree->name.'</option>'}}
				@else
				{{'<option value="'.$degree->id.'">'.$degree->name.'</option>'}}
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group hidden" id="form-branch">
		{{Form::label('branch_id' , 'Branch' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-6">
			<select name="branch_id" id="branch" class="form-control selectpicker">
				@foreach($branches as $branch)
				@if($user->branch_id == $branch->id)
				{{ '<option selected value="'.$branch->id.'">'.$branch->name.'</option>'}}
				@else
				{{ '<option value="'.$branch->id.'">'.$branch->name.'</option>'}}
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		{{Form::label('location_id' , 'Current Location' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-5">
			<input type="text" name="location_id" class="form-control" id="autocomplete" 
			value="{{$user->location->location or ''}}">
		</div>
	</div>
	<div class="form-group">
		{{Form::label('mobile' , 'Contact Number' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			{{Form::text('mobile' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('secondary_number' , 'Other Contact Number' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			{{Form::text('secondary_number' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('dob' , 'Date of Birth' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			<div class="date ">
				{{Form::text('dob' , null, array('class' => 'form-control datepicker', 'placeholder' => 'DD-MM-YYYY'))}}
			</div>
		</div>
	</div>
	<div class="form-group">
		{{Form::label('usn' , 'College USN' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-3">
			{{Form::text('usn' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('designation' , 'Current Designation' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-5">
			{{Form::text('designation' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('company_id' , 'Organisation' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-4">
			<select name="company_id" id="company" class="form-control selectpicker" data-live-search="true">
				@foreach($companies as $company)
				@if($user->company_id == $company->id)
				{{ '<option selected value="'.$company->id.'">'.$company->name.'</option>'}}
				@else
				{{ '<option value="'.$company->id.'">'.$company->name.'</option>'}}
				@endif
				@endforeach
			</select>
			<small>(Select 'None' to add a new organisation.)</small>
		</div>
	</div>
	<div class="form-group hidden new-company-div">
		{{Form::label('new_company' , 'Add an organisation' , array('class' => 'control-label col-md-3', "style" => "color:#337AB7;"))}}
		<div class="col-md-4">
			<input type="text" class="new_company form-control" name="new_company">
		</div>
	</div>
	<div class="form-group">
		{{Form::label('hobbies' , 'Hobbies' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-6">
			{{Form::text('hobbies' , null, array('class' => 'form-control' , 'id' => 'hobbies-textbox'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('fb_link' , 'Facebook Profile' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-5">
			{{Form::text('fb_link' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('linkedin_link' , 'LinkedIn Profile' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-5">
			{{Form::text('linkedin_link' , null, array('class' => 'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('profession_id' , 'Profession' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-4">
			<select name="profession_id" id="profession" class="form-control selectpicker dropup" data-live-search="true">
				@foreach($professions as $profession)
				@if($user->profession_id == $profession->id)
				{{'<option selected value="'.$profession->id.'">'.$profession->name.'</option>'}}
				@else
				{{'<option value="'.$profession->id.'">'.$profession->name.'</option>'}}
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		{{Form::label('domain' , 'Domain' , array('class' => 'control-label col-md-3'))}}
		<div class="col-md-4">
			<select name="domain[]" id="domain-select" multiple="multiple" class="selectpicker dropup" data-live-search="true">
				@foreach($domains as $domain)
				@if( in_array($domain->id, $user_domains))
				{{'<option selected value="'.$domain->id.'">'.$domain->name.'</option>'}}
				@else
				{{'<option value="'.$domain->id.'">'.$domain->name.'</option>'}}
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group new-domain-div">
		{{Form::label('new_domain' , 'Add a domain' , array('class' => 'control-label col-md-3', "style" => "color:#337AB7;"))}}
		<div class="col-md-4">
			<input type="text" class="new_domain form-control" name="new_domain">
		</div>
	</div>
	<hr>
	<div class="form-group">
		<label for="random" class="col-md-3 control-label"></label>
		<div class="col-md-8">
			<button class="btn btn-primary col-md-3" type="submit">Update</button>
		</div>
	</div>
	{{Form::close()}}
</div>
</div>
@overwrite