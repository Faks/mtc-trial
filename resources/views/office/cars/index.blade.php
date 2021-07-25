@extends('office.layout')

@section('content')
	<div class="header">
		<h4 class="title">Automašinas
			<small class="pull-right">
				<a class="#"
				   href="/office/dashboard/cars/create">
					<span class="fa fa-plus"></span> Pievienot Automašinu
				</a>
			</small>
		</h4>
	</div>
	
	<div class="content">
		<ul class="list-unstyled team-members">
			<li>
				<div class="row">
					<div class="col-xs-2 text-center">
						Ražotājs
					</div>
					
					<div class="col-xs-2 text-center">
						Nosakumums
					</div>
					
					<div class="col-xs-2 text-center">
						Tipāža
					</div>
					
					<div class="col-xs-2 text-center">
						API
					</div>
					
					<div class="col-xs-2 text-center">
						Bilde
					</div>
					
					<div class="col-xs-2 text-center">
						Riki
					</div>
				</div>
			</li>
			
			
			@foreach($model as $cars_listing)
				<li>
					<div class="row">
						<div class="col-xs-2 text-center">
							{{ $cars_listing->Make }}
						</div>
						
						<div class="col-xs-2 text-center">
							{{ $cars_listing->Name }}
						</div>
						
						<div class="col-xs-2 text-center">
							{{ $cars_listing->Trim }}
						</div>
						
						<div class="col-xs-2 text-center">
							@if ($cars_listing->Is_API == 'yes')
								<span class="text-success">Ja</span>
							@else
								<span class="text-warning">Ne</span>
							@endif
						</div>
						
						<div class="col-xs-2 text-center">
							@if (!is_null($cars_listing->Image) && !empty($cars_listing->Image))
								<span class="text-success">Ja</span>
							@else
								<span class="text-warning">Ne</span>
							@endif
						</div>
						
						
						<div class="col-xs-2 text-center ">
							<a href="{{ '/office/dashboard/cars/' . $cars_listing->id }}"
							   class="btn btn-sm btn-success btn-icon">
								<i class="fa fa-edit"></i>
							</a>
							<a href="{{ "/office/dashboard/cars/$cars_listing->id/destroy" }}"
							   class="btn btn-sm btn-success btn-icon">
								<i class="fa fa-trash"></i>
							</a>
						</div>
					</div>
				</li>
			@endforeach
		</ul>

		@include('pagination.default', ['paginator' => $model, 'elements' => $model])
	</div>
@stop