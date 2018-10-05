@extends('office.layout')

@section('content')
	@include('office.cars._form', compact('model') )
@stop