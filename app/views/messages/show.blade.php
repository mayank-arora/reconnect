<?php
use Carbon\Carbon;
?>
@extends('layouts.boilerplate')

@section('title')
<title>Messages</title>
<style>
	#terms-container {
   min-height:100%;
   position:relative;
}
#terms-body {
   padding:10px;
   padding-bottom:50px;   /* Height of the footer */
}
#terms-footer {/*
	padding-top: 25px;
	padding-bottom: 25px;*/
   position:absolute;
   bottom:0;
   right: 20px;
   width:100%;
   height:50px;
}
.terms-text{
	font-size: 12px;
	margin: 0;
	text-align: center;
}
.license-text{
	font-size: 12px;
	text-align: center;
}
</style>
<script>
if (!document.location.hash){
	document.location.hash = 'footer';
}
</script>
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
					{{ HTML::image('img/dp.png', 'profile-picture', array('class' => 'thumbnail profile-display-pic-messages' , 'width' => '100px')) }}
					@else
					{{ HTML::image('uploads/'.$user->picture, 'profile-picture', array('class' => 'thumbnail profile-display-pic-messages' , 'width' => '100px')) }}
					@endif
					
				</div>
				<div class="row">
					<a href="{{URL::route('users.show',$user->id)}}" style="text-decoration:none;"><h1 style="color:#337AB7;">{{$user->fname}} {{$user->lname}}</h1></a>
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
					<div class="profile-detail-div detail-domain">
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
						<a href="{{$user->fb_link}}"class="social-links"><span class="fa fa-facebook-official"></span>
						</a>
						@endif
						@if($user->linkedin_link!=NULL)
						<a href="{{$user->linkedin_link}}" class="social-links"><span class="fa fa-linkedin"></span>
						</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7 col-md-offset-1">
			<div class="white-container">
				<div id="messages-container">
					@foreach($recipient_messages->messages as $message)
					@if($message->way == 'out')
					<div class="message-text-out">
						<div class="outgoing-textbox">
							<p>{{$message->text}}</p>
							<div class="time-out">
								<div class="time-blob">
									<small>
										<?php
										$now=Carbon::now();
										$post_time=Carbon::parse($message->time);
										$post_time->setTimeZone('Asia/Kolkata');
										$differenceInDays = $now->diffInDays($post_time);
										$differenceInYears = $now->diffInyears($post_time);
										?>

										@if($differenceInDays<1)
										{{$post_time->format('M d \a\t H:i')}}
										@elseif($differenceInYears<1)
										{{$post_time->format('M d \a\t H:i')}}
										@else
										{{$post_time->format('M d, Y \a\t H:i')}}
										@endif
									</small>
								</div>
							</div>
						</div>
					</div>
					@else
					<div class="message-text-in">
						<div class="incoming-textbox">
							<p>{{$message->text}}</p>
							<div class="time-in">
								<div class="time-blob">
									<small>
										<?php
										$now=Carbon::now();
										$post_time=Carbon::parse($message->time);
										$differenceInDays = $now->diffInDays($post_time);
										$differenceInYears = $now->diffInyears($post_time);
										?>
										@if($differenceInDays<1)
										{{$post_time->format('M d \a\t H:i')}}
										@elseif($differenceInYears<1)
										{{$post_time->format('M d \a\t H:i')}}
										@else
										{{$post_time->format('M d, Y \a\t H:i')}}
										@endif
									</small>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endforeach
					<div class="gap" id="footer"></div>
				</div>
				<form action="{{URL::route('message.store', $user->id)}}" id="input-form" method="post">
					<div class="input-group">
						<input type="text" name="text" class="form-control">
						<input type="hidden" name="id" value="{{$user->id}}">
						<span class="input-group-addon message-send"  onclick="submit()">
							<span class="fa fa-send"></span>
						</span>
					</div>
				</form>
				<script>
				function submit() {
					document.getElementById("input-form").submit();
				}
				</script>
			</div>
		</div>
	</div>
</div>
</div>
@overwrite
