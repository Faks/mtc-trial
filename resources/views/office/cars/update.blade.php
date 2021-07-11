@extends('office.layout')

@section('content')
	@include('office.cars._form', ['action' => '/office/dashboard/car/update' , compact('model' , 'nameKey' , 'valueKey', 'name' , 'value') ])
@stop