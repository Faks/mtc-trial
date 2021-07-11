<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar bar1"></span>
				<span class="icon-bar bar2"></span>
				<span class="icon-bar bar3"></span>
			</button>
			@if ($_SESSION['authenticated'])
			<a class="navbar-brand" href="/office/dashboard/api/create/cars">
				<span class="fa fa-plus"></span> Pievienot Automašinas no API
			</a>
			@endisset
		</div>
		<div class="collapse navbar-collapse">

			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
					<a class="nav-link" href="https://bitbucket.org/Faks/mtc-trial/src/">Bitbucket</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="https://www.linkedin.com/in/oskars-germovs-a94b3318a/">LinkedIn</a>
				</li>
				<li>

					@if ($_SESSION['authenticated'])
					<a href="/logout">
						<i class="fa fa-sign-out"></i>
						<p>Atslēgties </p>
					</a>
					@else
						<a href="/login">
							<i class="fa fa-sign-out"></i>
							<p>Ienākt </p>
						</a>
					@endif
				</li>
			</ul>
		</div>
	</div>
</nav>
