@extends('layouts.boilerplate')

@section('title')
<title>Post by {{$post->user->fname}}</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')

<div class="container">
	<div class="row">
		<div class="col-md-8">
			@include('partials._text-post', array('post' =>$post))
		</div>
		<div class="col-md-4" ></div>
	</div>
</div>

@overwrite