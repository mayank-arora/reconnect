@extends('layouts.boilerplate')

@section('title')
<title>Search</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<h3>{{$profession->name}}</h3>
	<div class="gap"></div>
	@foreach($profession->users as $user)
	@include('partials._user-detail-hud')
	@endforeach
</div>
@overwrite