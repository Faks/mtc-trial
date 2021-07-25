@extends('office.layout')

@section('content')
    @include('office.cars._form', ['action' => '/office/dashboard/cars/create' ,
    compact('model' , 'nameKey' , 'valueKey', 'name' , 'value') ])
@stop