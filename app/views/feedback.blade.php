@extends('layouts.boilerplate')

@section('title')
<title>Feedback Page</title>
<style>
.title-div{
	text-align: center;
}
.title{
	color: #337AB7;
	margin-top: 0;
}
.list-group-item{
	border-color: #E5E6E9 #DFE0E4 #D0D1D5 !important;
}
.detail-div{
	/*padding: 10px;*/
	text-align: center;
	border-top: 1px solid #E5E6E9;
}
.detail-tab{
	padding: 10px;
}
.detail-tab:hover{
	background-color: #eee;
	-webkit-transition: background-color 0.2s;
	-o-transition: background-color 0.2s;
	transition: background-color 0.2s;
}
.white-container{
	padding-left:0;
	padding-right: 0; 
	padding-bottom: 0;
}

</style>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="title-div">
		<h1 class="title">The website is still under development.</h1>
		<h4>Encounter any bug? Or have any sugesstions? Contact us!</h4>
	</div>
	<div class="gap"></div>
	<h4 class="title-div">Known issues</h4>
	<div class="col-md-6">
		<ul class="list-group">
			<li class="list-group-item">Cannot add multiple domains ar once.</li>
			<li class="list-group-item">No way of knowing when you recieve a new message.</li>
			<li class="list-group-item">Events cannot be created.</li>

		</ul>
	</div>
	<div class="col-md-6">
		<ul class="list-group">	
			<li class="list-group-item">Cannot access the list of users by location.</li>
			<li class="list-group-item">Manual validation required for every new user.</li>
			<li class="list-group-item">Cannot hide personal information from other users.
			</li>
		</ul>
	</div>
	<div class="contact-div">
		<div class="col-md-6">
			<div class="col-md-6 col-md-offset-6"  style="padding-right:0;padding-left:0;">
				<div class="white-container">
					<h4 class="title-div title">Mayank Arora</h4>
					<p class="title-div">Website Developer</p>
					<div class="gap"></div>
					<div class="detail-div">
						<div class="detail-tab col-md-6" style="padding-left:0;padding-right:0;border-right:1px solid #e5e6e9">Message
							<a href="{{URL::route('message.show',1)}}"><span class="link-setter"></span></a>
						</div>
						<div class="detail-tab col-md-6" style="padding-left:0;padding-right:0;">Email
							<a href="mailto:mayankarora.0992@gmail.com"><span class="link-setter"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6" style="padding-right:0;padding-left:0;">
				<div class="white-container">
					<h4 class="title-div title">Aranya Khinvasara</h4>
					<p class="title-div">Alumni Coordinator</p>
					<div class="gap"></div>
					<div class="detail-div">
						<div class="detail-tab col-md-6" style="padding-left:0;padding-right:0;border-right:1px solid #e5e6e9">Message
							<a href="{{URL::route('message.show',6)}}"><span class="link-setter"></span></a>
						</div>
						<div class="detail-tab col-md-6" style="padding-left:0;padding-right:0;">Email
							<a href="mailto:aranya175@gmail.com"><span class="link-setter"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@overwrite