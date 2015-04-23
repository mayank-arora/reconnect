@extends('layouts.boilerplate')

@section('title')
<title>Discussion Board</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="col-md-3 hud flex">
		<a href="{{URL::route('discussions.create')}}"><span class="link-setter"></span></a>
		<div class="aligner"><span class="fa fa-edit"></span> </div>
	</div>
	@foreach($discussions as $discussion)
	@include('partials._discussionHud')
	@endforeach
</div>
@overwrite