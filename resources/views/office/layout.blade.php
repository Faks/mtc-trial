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
		
		@include('office.template.footer')
	
	</div>
</body>

<!--   Core JS Files   -->
@include('office.template.script')
</html>