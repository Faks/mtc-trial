<div class="sidebar-wrapper">
	<div class="logo">
		<a href="http://solum-designum.tk" class="simple-text">
			Solum DeSignum
		</a>
	</div>
	
	<ul class="nav">
		
		<li class="@if ((string)$_SERVER['PATH_INFO'] == '/office/dashboard') active @endif">
			<a href="/office/dashboard">
				<i class="fa fa-list"></i>
				<p>Galvenā Sadaļa</p>
			</a>
		</li>
		
		<li class="@if ((string)$_SERVER['PATH_INFO'] == '/office/dashboard/cars') active @endif">
			<a href="/office/dashboard/cars">
				<i class="fa fa-object-group"></i>
				<p>Automašīnas</p>
			</a>
		</li>
		
	</ul>
</div>