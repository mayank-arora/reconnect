@extends('layouts.boilerplate')

@section('title')
<title>Ssup</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')

<div class="container">
	<?php
	$award = new stdClass;
		$awards = array($award);
	?>
</div>

{{$batches->links()}}

@overwrite