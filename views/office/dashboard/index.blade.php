@php
	use src\Purifier;
@endphp

@extends('office.layout')

@section('content')
	<div class="header">
		<h3 class="title">Welcome Back {{ Purifier::clean($_SESSION['auth']['username']) }}</h3>
	</div>
	
	<div class="content">
		<p></p>
	</div>
@stop