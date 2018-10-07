<!--
	 **
	 * Created by PhpStorm.
	 * User: Faks
	 * GitHub: https://github.com/Faks
	 *******************************************
	 * Company Name: Solum DeSignum
	 * Company Website: http://solum-designum.com
	 * Company GitHub: https://github.com/SolumDeSignum
	 ********************************************************
	 * Date: 2018.10.07.
	 * Time: 14:14
	 *
-->
@php
	use src\Purifier;
@endphp

@extends('office.layout')

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
					<img src=" @if (!empty($car->Image) && !is_null($car->Image)) {{ Purifier::clean($car->Image) }} @else sample.jpg @endif ">
					<div class="caption">
						<h4><a>{{ (string)Purifier::clean($car->Make) }} {{ Purifier::clean($car->Name) }}</a></h4>
						<p>Izlaiduma gads: {{ Purifier::clean($car->Year) }}</p>
						<p>Virsbūves tips: {{ Purifier::clean($car->Body) }}</p>
						<p>Motora Pozicija: {{ Purifier::clean($car->Engine_Position) }}</p>
						<p>Motora Kompresija: {{ Purifier::clean($car->Engine_Compression) }}</p>
						<p>Motora Tips: {{ Purifier::clean($car->Engine_Type) }}</p>
						<p>Motora Degviela: {{ Purifier::clean($car->Engine_Fuel) }}</p>
						<p>Valsts: {{ Purifier::clean($car->Country) }}</p>
						<p>Ātrumkārba: {{ Purifier::clean($car->Transmission_Type) }}</p>
						<p>Svars: {{ Purifier::clean($car->Weight_KG) }} Kg</p>
						<small>{{ Purifier::clean($car->Trim) }}</small>
						<p class="text-center" style="font-weight: bold;">Price: {{ Purifier::clean($car->Price) }}</p>
					</div>
				</div>
			</div>
		@endforeach
		
		<div class="col-md-12">
			{{ $model->links() }}
		</div>
	</div>
@stop
@push('content_js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function()
	{
		$("#Name").autocomplete({
			source: "https://mtc.solum-designum.com/name/filter",
			delay: 30,
			minLength: 1,
			cache: true
		});
		
		$("#PriceFrom").autocomplete({
			source: "https://mtc.solum-designum.com/price/filter",
			delay: 30,
			minLength: 1,
			cache: true
		});
		
		$("#PriceTill").autocomplete({
			source: "https://mtc.solum-designum.com/price/filter",
			delay: 30,
			minLength: 1,
			cache: true
		});
		
		$("#Country").autocomplete({
			source: "https://mtc.solum-designum.com/country/filter",
			delay: 30,
			minLength: 1,
			cache: true
		});
	});
</script>
@endpush