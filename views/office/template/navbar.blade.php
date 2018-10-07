<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar bar1"></span>
				<span class="icon-bar bar2"></span>
				<span class="icon-bar bar3"></span>
			</button>
			@if (!empty($_SESSION['auth']))
			<a class="navbar-brand" href="/office/dashboard/api/create/cars"><span class="fa fa-plus"></span> Pievienot Automašinas no API</a>
			@endif
		</div>
		<div class="collapse navbar-collapse">
			
			<ul class="nav navbar-nav navbar-right">
				<li>
					@if (!empty($_SESSION['auth']))
					<a href="/logout">
						<i class="fa fa-sign-out"></i>
						<p>Atslēgties </p>
					</a>
					@else
						<a href="/logout">
							<i class="fa fa-sign-out"></i>
							<p>Ienākt </p>
						</a>
					@endif
				</li>
			</ul>
		</div>
	</div>
</nav>
