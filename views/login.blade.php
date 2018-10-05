<!--
	 * Created by PhpStorm.
	 * User: Faks
	 * GitHub: https://github.com/Faks
	 *******************************************
	 * Company Name: Solum DeSignum
	 * Company Website: http://solum-designum.com
	 * Company GitHub: https://github.com/SolumDeSignum
	 ********************************************************
	 * Date: 2018.10.04.
	 * Time: 23:13
	 *
-->
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	
	<title>Solum DeSignum</title>
	
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
	<meta name="viewport" content="width=device-width"/>
	
	<!-- Bootstrap Custom CSS     -->
	<link href="assets/css/boostrap-custom.css" rel="stylesheet"/>
	
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

</head>

<body id="login-body">
	<div class="col-lg-12">
		<div class="container">
			<div class="container-fluid">
				<div class="row col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 custom-form">
					<h2 class="text-primary text-center">Login</h2>
					
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
						
					<form class="form-horizontal" id="login-input" action="/login" method="POST">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" id="username" placeholder="Enter User Name" name="username">
							</div>
						</div>
						
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
							</div>
						</div>
						
						
						<div class="form-group">
							<div class=" col-sm-12">
								<button class="btn btn-info btn-100"><i class="fa fa-sign-in fa-2x"></i></button>
							</div>
						</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

<!--   Core JS Files   -->
<script src="/assets/js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/js/jasny-bootstrap.min.js"></script>
<script src="/assets/js/bootstrap-checkbox-radio.js"></script>
<script src="/assets/js/bootstrap-custom.js"></script>
<script src="/assets/js/summernote.min.js"></script>
</html>