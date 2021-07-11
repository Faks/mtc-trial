@extends('office.layout')

@php
	use App\Services\PurifierService;
@endphp

@push('content_css')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<style type="text/css">
		.ui-autocomplete {
			max-height: 100px;
			overflow-y: auto;
			/* prevent horizontal scrollbar */
			overflow-x: hidden;
		}
		/* IE 6 doesn't support max-height
		 * we use height instead, but this forces the menu to always be this tall
		 */
		* html .ui-autocomplete {
			height: 100px;
		}
	</style>
@endpush

@section('content')
	<div class="header">
		<h4 class="title">Automašinas</h4>
	</div>

	<div class="content">
		@foreach ($model as $car)
			<div class="col-md-3">
				<div class="thumbnail">
					<img src=" @if (!empty($car->Image) && !is_null($car->Image)) {{ PurifierService::clean($car->Image) }}
					@else http://lorempixel.com/420/420/sports/ @endif ">
					<div class="caption">
						<h4>
							<a>{{ PurifierService::clean($car->Make) }} {{ PurifierService::clean($car->Name) }}</a>
						</h4>
						<p>Izlaiduma gads: {{ PurifierService::clean($car->Year) }}</p>
						<p>Virsbūves tips: {{ PurifierService::clean($car->Body) }}</p>
						<p>Motora Pozicija: {{ PurifierService::clean($car->Engine_Position) }}</p>
						<p>Motora Kompresija: {{ PurifierService::clean($car->Engine_Compression) }}</p>
						<p>Motora Tips: {{ PurifierService::clean($car->Engine_Type) }}</p>
						<p>Motora Degviela: {{ PurifierService::clean($car->Engine_Fuel) }}</p>
						<p>Valsts: {{ PurifierService::clean($car->Country) }}</p>
						<p>Ātrumkārba: {{ PurifierService::clean($car->Transmission_Type) }}</p>
						<p>Svars: {{ PurifierService::clean($car->Weight_KG) }} Kg</p>
						<small>{{ PurifierService::clean($car->Trim) }}</small>
						<p class="text-center" style="font-weight: bold;">
							Price: {{ PurifierService::clean($car->Price) }}</p>
					</div>
				</div>
			</div>
		@endforeach

		<div class="col-md-12">
			@include('pagination.default', ['paginator' => $model, 'elements' => $model])
		</div>
	</div>
@stop
@push('content_js')
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$(document).ready(function () {
			$("#Name").autocomplete({
				source: "/api/v1/car-name",
				delay: 30,
				minLength: 1,
				cache: true
			});

			$("#PriceFrom").autocomplete({
				source: "/api/v1/price",
				delay: 30,
				minLength: 1,
				cache: true
			});

			$("#PriceTill").autocomplete({
				source: "/api/v1/price",
				delay: 30,
				minLength: 1,
				cache: true
			});

			$("#Country").autocomplete({
				source: "/api/v1/country",
				delay: 30,
				minLength: 1,
				cache: true
			});
		});
	</script>
@endpush