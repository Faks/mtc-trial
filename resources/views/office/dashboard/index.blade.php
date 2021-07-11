@extends('office.layout')

@php
	use App\Services\PurifierService;
@endphp

@section('content')
	<div class="header">
		<h3 class="title">Welcome Back {{ PurifierService::clean($_SESSION['user']['username']) }}</h3>
	</div>
	
	<div class="content">
		<p></p>
	</div>
@endsection