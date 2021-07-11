@php
	use App\Services\PurifierService;
@endphp

<div class="sidebar-wrapper">
	<div class="logo">
		<a href="http://solum-designum.eu" class="simple-text">
			Solum DeSignum
		</a>
	</div>

	<ul class="nav" style="overflow: hidden;">
		@if (!empty($_SESSION['authenticated']))
			<li class="">
				<a href="/office/dashboard">
					<i class="fa fa-list"></i>
					<p>Galvenā Sadaļa</p>
				</a>
			</li>
			
			<li class="">
				<a href="/office/dashboard/cars">
					<i class="fa fa-object-group"></i>
					<p>Automašīnas</p>
				</a>
			</li>
		@else
			<li class="">
				<a href="/" class="">
					<i class="fa fa-search" aria-hidden="true" style="line-height: inherit !important;;"></i>
					<p>Automašinas</p>
				</a>
			</li>
		
			<form class="form-horizontal" method="GET">
				
				<span>
					<label for="Name" style="display: block;">
						Nosaukums
					</label>
					
					<div class="ui-widget">
					<input type="text" name="Name" id="Name" @if(!empty($_GET['Name'])) value="{{ PurifierService::clean($_GET['Name'])}}" @endif autocomplete="true" autofocus class="form-control border-input">
					</div>
				</span>
				
				<span>
					<label for="PriceFrom" style="display: block;">
						Cena: No
					</label>
					
					<div class="ui-widget">
						<input type="text" name="PriceFrom" id="PriceFrom" @if(!empty($_GET['PriceFrom'])) value="{{ PurifierService::clean($_GET['PriceFrom'])}}" @endif autocomplete="true" autofocus class="form-control border-input">
					</div>
				</span>
				
				<span>
					<label for="PriceTill" style="display: block;">
						Cena: Līdz
					</label>
					
					<div class="ui-widget">
						<input type="text" name="PriceTill" id="PriceTill" @if(!empty($_GET['PriceTill'])) value="{{ PurifierService::clean($_GET['PriceTill'])}}" @endif autocomplete="true" autofocus class="form-control border-input">
					</div>
				</span>
				
				<span>
					<label for="Name" style="display: block;">
						Valsts
					</label>
					
					<div class="ui-widget">
					<input type="text" name="Country" id="Country" @if(!empty($_GET['Country'])) value="{{ PurifierService::clean($_GET['Country'])}}" @endif autocomplete="true" autofocus class="form-control border-input">
					</div>
				</span>
				
				<span>
					<label for="Name" style="display: block;">
						Tagi
					</label>
					
						<select name="Tags" class="form-control border-input">
							<option value="" @if(!empty($_GET['Tags'])) selected @endif >--Lūdzu Izvēlies--</option>
						@foreach($model_tags as $tag)
							@if (!empty($tag->Tags))
								<option value="{{ PurifierService::clean($tag->Tags) }}"  @if(!empty($_GET['Tags'])) selected @endif >{{ PurifierService::clean($tag->Tags) }}</option>
							@endif
						@endforeach
						</select>
				</span>
				
				<input type="hidden" name="{{ $nameKey }}" value="{{ $name }}">
				<input type="hidden" name="{{ $valueKey }}" value="{{ $value }}">
				
				<button class="btn btn-default" type="submit"  style="margin-top: 15px;">Meklēt</button>
			</form>
				
		@endif
	</ul>
</div>