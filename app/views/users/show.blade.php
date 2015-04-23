@extends('layouts.boilerplate')

@section('title')
<title>Messages</title>
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
					<div class="profile-detail-div detail-designation">
						<h5>
							<span class="grey-text">Designation</span>
							<p style="float:right;">{{$user->designation}}</p>
						</h5>
					</div>
					<div class="profile-detail-div detail-company">
						<h5>
							<span class="grey-text">Company</span>
							<p style="float:right;">
								@if($user->company_id!=NULL)
								{{$user->company->name}}
								@endif
							</p>
						</h5>
					</div>
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
					<div class="profile-detail-div detail-branch">
						<h5>
							<span class="grey-text">Branch</span>
							<p style="float:right;">
								@if(isset($user->branch))
								{{$user->branch->name}}</p>
								@endif
							</h5>
						</div>
						<div class="profile-detail-div detail-location">
							<h5>
								<span class="grey-text">Location</span>
								<p style="float:right;">{{$user->location->location or ''}}</p>
							</h5>
						</div>
						<div class="profile-detail-div detail-mobile">
							<h5>
								<span class="grey-text">Mobile</span>
								<p style="float:right;">{{$user->mobile}}</p>
							</h5>
						</div>
						<div class="profile-detail-div detail-email">
							<h5>
								<span class="grey-text">Email</span>
								<p style="float:right;">{{$user->email}}</p>
							</h5>
						</div>
						<div class="profile-detail-div detail-view" style="text-align:right;">
							<h5><a class="profile-view-more">View More</a></h5>
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
				@foreach($user->posts as $post)
				<div class="white-container">
					<p>{{$post->text_content}}</p>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	@overwrite 