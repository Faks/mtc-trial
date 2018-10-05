<!doctype html>
<html lang="en">
<head>
	@include('office.template.header')
</head>
<body>
	<nav class="sidebar" data-active-color="danger" data-background-color="black" data-mh="my-group">
		
		<!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
		@include('office.template.sidebar')
	</nav>

	<div class="main-panel" data-mh="my-group">
	
		@include('office.template.navbar')
		
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- Modal -->
		<div class="modal fade" id="Confirm" tabindex="-1" role="dialog" aria-labelledby="confirm-title-label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="confirm-title-label">Delete title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Vai esat parliecinati ka velaties dzest ?
					</div>
					<div class="modal-footer">
						<a type="button" class="btn btn-secondary" data-dismiss="modal">Ne</a>
						<a href="#" type="button"  class="btn btn-danger">Ja</a>
					</div>
				</div>
			</div>
		</div>
		
		
		@include('office.template.footer')
	
	</div>
</body>

<!--   Core JS Files   -->
@include('office.template.sidebar')

</html>