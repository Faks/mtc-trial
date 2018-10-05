@if (!empty($errors))
	@php unset($_SESSION['errors']) @endphp
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			{!! $error !!} <br>
		@endforeach
	</div>
@endif

@if (!empty($_SESSION["errors"][0]))
	<div class="alert alert-danger">
		{!! $_SESSION["errors"][0] !!} <br>
	</div>
@endif