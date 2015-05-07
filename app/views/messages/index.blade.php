@extends('layouts.boilerplate')

@section('title')
<title>Messages</title>
@overwrite


@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<div class="gap"></div>

	@foreach($file as $sender)
	@include('partials._message-hud')
	@endforeach

</div>
@overwrite
