@extends('layouts.boilerplate')


@section('title')
<title>Home</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
@if(isset($_SESSION['post_id']))
<script>
	$(document).ready(function(){
	$(document).scrollTop( $("#section{{Session::get('post_id')}}").offset().top );
	});
</script>
@endif
<div class="container">
	<div class="row">
		<div class="col-md-8">
			{{Form::open(array('action' => 'PostsController@store','method' => 'post'))}}
				<div class="form-group">
					<textarea style="resize:none;" name="text_content" id=""
					cols="20" rows="4" class="form-control"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Post</button>
			{{Form::close()}}
			<hr>
		@foreach($posts as $post)
		@include('partials._text-post', array('post' =>$post))
		@endforeach
		</div>
		<div class="col-md-4" ></div>
	</div>
</div>
@overwrite