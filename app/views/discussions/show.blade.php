@extends('layouts.boilerplate')

@section('title')
<title>Thread by {{$discussion->user->fname}}</title>
@overwrite

@section('navbar')
@include('partials._navbar')
@overwrite

@section('body')
@include('partials._discussionPost')


@overwrite