@extends('layouts.boilerplate')

@section('title')
<title>New Thread</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')

<div class="container">
	<div class="col-md-8">
		<form action="{{URL::route('discussions.store')}}" class="form-group" method="post">
			<div class="form-group">
				<input type="text" placeholder="Title" name="title" class="form-control">
			</div>
			<div class="form-group">
				<textarea style="resize:none;" name="text_content" rows="10" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" value="Create" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>

@overwrite