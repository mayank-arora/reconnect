@extends('layouts.boilerplate')

@section('title')
<title>Search</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	<h3>Batch {{$batch->value}}</h3>
	<div class="gap"></div>
	@foreach($batch->users as $user)
	@include('partials._user-detail-hud')
	@endforeach
</div>
@overwrite