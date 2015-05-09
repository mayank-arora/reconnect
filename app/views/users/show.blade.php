@extends('layouts.boilerplate')

@section('title')
<title>{{$user->fname}} {{$user->lname}}</title>
@overwrite


@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="white-container profile-container">
				<div class="row">
					@if($user->picture == NULL)
					{{ HTML::image('img/dp.png', 'profile-picture', array('class' => 'thumbnail profile-display-pic' , 'width' => '100px')) }}
					@else
					{{ HTML::image('uploads/'.$user->picture, 'profile-picture', array('class' => 'thumbnail profile-display-pic' , 'width' => '100px')) }}
					@endif
					
				</div>
				<div class="row">
					<h1 style="color:#337AB7;">{{$user->fname}} {{$user->lname}} 
						@include('partials._editTinker')
					</h1>

					<div class="profile-detail-div detail-batch">
						<h5>
							<span class="grey-text">Batch</span>
							<p style="float:right;">
								@if($user->batch_id!=NULL)
								@if($user->batch_id!= 20)
								{{($user->batch->value - 4).' - '.$user->batch->value}}
								@else
								{{$user->batch->value}}
								@endif
								@endif
							</p>
						</h5>
					</div>

					@if($user->degree_id != NULL)
					@if($user->batch_id!=20)
					<div class="profile-detail-div detail-degree">
						<h5>
							<span class="grey-text">Degree</span>
							<p style="float:right;">
								@if($user->degree_id!=NULL)
								{{$user->degree->name}}
								@endif
							</p>
						</h5>
					</div>
					@endif
					@endif

					<div class="profile-detail-div detail-branch">
						<h5>
							<span class="grey-text">Branch</span>
							<p style="float:right;">
								@if(isset($user->branch_id))
								{{$user->branch->name}}
								@endif
							</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-location">
						<h5>
							<span class="grey-text">Location</span>
							<p style="float:right;">{{$user->location->location or ''}}</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-email">
						<h5>
							<span class="grey-text">Email</span>
							<p style="float:right;">{{$user->email}}</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-mobile">
						<h5>
							<span class="grey-text">Mobile</span>
							<p style="float:right;">{{$user->mobile}}</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-view" style="text-align:right;">
						<h5><a class="profile-view-more">View More</a></h5>
					</div>

					<div class="profile-detail-div detail-designation hide">
						<h5>
							<span class="grey-text">Designation</span>
							<p style="float:right;">{{$user->designation}}</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-company hide">
						<h5>
							<span class="grey-text">Organisation</span>
							<p style="float:right;">
								@if($user->company_id!=NULL)
								{{$user->company->name}}
								@endif
							</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-profession hide">
						<h5>
							<span class="grey-text">Profession</span>
							<p style="float:right;">
								@if($user->profession!=NULL)
								{{$user->profession->name}}
								@endif
							</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-hobbies hide">
						<h5>
							<span class="grey-text">Hobbies</span>
							<p style="float:right;">{{$user->hobbies}}</p>
						</h5>
					</div>

					<div class="profile-detail-div detail-domain hide">
						<h5>
							<span class="grey-text">Domain</span>
							<p style="float:right;">
								@foreach($user->domains as $domain)
								<a href="{{URL::route('users.domain',$domain->id)}}">{{$domain->name}}</a><span> </span>
								@endforeach
							</p>
						</h5>
					</div>

					<div class="social-links-div">
						@if($user->fb_link!=NULL)
						<a href="{{$user->fb_link}}"class="social-links"><span class="fa fa-facebook-official"></span></a>
						@endif
						@if($user->linkedin_link!=NULL)
						<a href="{{$user->linkedin_link}}" class="social-links"><span class="fa fa-linkedin"></span></a>
						@endif
						@if($user->id!= Auth::id())
						<a href="{{URL::route('message.show', $user->id)}}" class="social-links"><span class="fa fa-envelope"></span></a>
						@endif
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-7 col-md-offset-1">
			<div class="white-container">
				<h3 style="margin-bottom:30px;color:#337AB7;">Awards</h3>
				@if($user->id == Auth::id())
				<span class="fa fa-pencil-square-o add-btn" id="award-add-btn"></span>
				<form action="{{URL::action('UsersController@addAward', $user->id)}}" method="post" class="form-horizontal hidden" id="award-add-form">
					<div class="form-group">
						{{Form::label('year' , 'Year' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							{{Form::text('year' , null, array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('description' , 'Title' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-10">
							{{Form::textarea('description' , null, array('class' => 'form-control', 'style' => 'resize:none;'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('' , '' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary" value="Add">
						</div>
					</div>

				</form>
				@endif
				@foreach($profile_data[0] as $award)
				@include('partials._profile-data-element')
				@endforeach
			</div>

			<div class="white-container">
				<h3 style="margin-bottom:30px;color:#337AB7;">Roles</h3>
				@if($user->id == Auth::id())
				<span class="fa fa-pencil-square-o add-btn" id="role-add-btn"></span>
				<form action="{{URL::action('UsersController@addRole', $user->id)}}" method="post" class="form-horizontal hidden" id="role-add-form">
					<div class="form-group">
						{{Form::label('year' , 'Year' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							{{Form::text('year' , null, array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('description' , 'Title' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-10">
							{{Form::textarea('description' , null, array('class' => 'form-control', 'style' => 'resize:none;'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('' , '' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary" value="Add">
						</div>
					</div>

				</form>
				@endif
				@foreach($profile_data[1] as $award)
				@include('partials._profile-data-element')
				@endforeach
			</div>

			<div class="white-container">
				<h3 style="margin-bottom:30px;color:#337AB7;">Achievements</h3>
				@if($user->id == Auth::id())
				<span class="fa fa-pencil-square-o add-btn" id="achieve-add-btn"></span>
				<form action="{{URL::action('UsersController@addAchievement', $user->id)}}" method="post" class="form-horizontal hidden" id="achieve-add-form">
					<div class="form-group">
						{{Form::label('year' , 'Year' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							{{Form::text('year' , null, array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('description' , 'Title' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-10">
							{{Form::textarea('description' , null, array('class' => 'form-control', 'style' => 'resize:none;'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('' , '' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary" value="Add">
						</div>
					</div>

				</form>
				@endif
				@foreach($profile_data[2] as $award)
				@include('partials._profile-data-element')
				@endforeach
			</div>

			<div class="white-container">
				<h3 style="margin-bottom:30px;color:#337AB7;">Higher Studies</h3>
				@if($user->id == Auth::id())
				<span class="fa fa-pencil-square-o add-btn" id="study-add-btn"></span>
				<form action="{{URL::action('UsersController@addStudy', $user->id)}}" method="post" class="form-horizontal hidden" id="study-add-form">
					<div class="form-group">
						{{Form::label('year' , 'Year' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							{{Form::text('year' , null, array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('description' , 'Title' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-10">
							{{Form::textarea('description' , null, array('class' => 'form-control', 'style' => 'resize:none;'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('' , '' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary" value="Add">
						</div>
					</div>

				</form>
				@endif
				@foreach($profile_data[3] as $award)
				@include('partials._profile-data-element')
				@endforeach
			</div>

			<div class="white-container">
				<h3 style="margin-bottom:30px;color:#337AB7;">Corporate Social Responsibilities</h3>
				@if($user->id == Auth::id())
				<span class="fa fa-pencil-square-o add-btn" id="csr-add-btn"></span>
				<form action="{{URL::action('UsersController@addCsr', $user->id)}}" method="post" class="form-horizontal hidden" id="csr-add-form">
					<div class="form-group">
						{{Form::label('year' , 'Year' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							{{Form::text('year' , null, array('class' => 'form-control'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('description' , 'Title' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-10">
							{{Form::textarea('description' , null, array('class' => 'form-control', 'style' => 'resize:none;'))}}
						</div>
					</div>
					<div class="form-group">
						{{Form::label('' , '' , array('class' => 'control-label col-md-2'))}}
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary" value="Add">
						</div>
					</div>

				</form>
				@endif
				@foreach($profile_data[4] as $award)
				@include('partials._profile-data-element')
				@endforeach
			</div>

			<div class="white-container">
				<h3 style="margin-bottom:30px;color:#337AB7;">Contact for</h3>
				@foreach($profile_data[6] as $key => $value)
				@if($value == '1')
				<div class="profile-data-element-container">
					<div class="profile-data-element-year">
						<p>{{$key}}</p>
					</div>
				</div>
				@endif
				@endforeach
			</div>

		</div>

	</div>
</div>
@overwrite 