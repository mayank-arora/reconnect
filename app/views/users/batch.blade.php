@extends('layouts.boilerplate')

@section('title')
<title>Search</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
<div class="container">
	@if($id != 20)
	<h3>Batch {{$batch->value}}</h3>
	@else
	<h3>{{$batch->value}}</h3>
	@endif
	<div class="gap"></div>
	@foreach($batch->users as $user)
	@include('partials._user-detail-hud')
	@endforeach
</div>
@overwrite