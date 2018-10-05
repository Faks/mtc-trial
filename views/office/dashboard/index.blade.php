@extends('office.layout')

@section('content')
	<div class="header">
		<h4 class="title">Raksti</h4>
	</div>
	
	<div class="content">
		<ul class="list-unstyled team-members">
			<li>
				<div class="row">
					<div class="col-xs-3 text-center">
						Virsraksts
					</div>
					
					<div class="col-xs-3 text-center">
						Publiskot
					</div>
					
					<div class="col-xs-3 text-center">
						Bilde
					</div>
					
					
					<div class="col-xs-3 text-center">
						Riki
					</div>
				</div>
			</li>
			
			
			<li>
				<div class="row">
					<div class="col-xs-3 text-center">
						Par Oliem ?
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-success">Ja</span>
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-success">Ja</span>
					</div>
					
					<div class="col-xs-3 text-center ">
						<a href="articles_manage_edit.html" class="btn btn-sm btn-success btn-icon"><i class="fa fa-edit"></i></a>
						<button href="#" class="btn btn-sm btn-success btn-icon" data-toggle="modal"  data-target="#Confirm"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</li>
			
			<li>
				<div class="row">
					<div class="col-xs-3 text-center">
						Par Oliem ?
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-success">Ja</span>
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-success">Ja</span>
					</div>
					
					<div class="col-xs-3 text-center ">
						<a href="articles_manage_edit.html" class="btn btn-sm btn-success btn-icon"><i class="fa fa-edit"></i></a>
						<button href="#" class="btn btn-sm btn-success btn-icon" data-toggle="modal"  data-target="#Confirm"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</li>
			
			<li>
				<div class="row">
					<div class="col-xs-3 text-center">
						Par Oliem ?
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-success">Ja</span>
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-success">Ja</span>
					</div>
					
					<div class="col-xs-3 text-center ">
						<a href="articles_manage_edit.html" class="btn btn-sm btn-success btn-icon"><i class="fa fa-edit"></i></a>
						<button href="#" class="btn btn-sm btn-success btn-icon" data-toggle="modal"  data-target="#Confirm"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</li>
			
			<li>
				<div class="row">
					<div class="col-xs-3 text-center">
						Par Oliem ?
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-danger">Ne</span>
					</div>
					
					<div class="col-xs-3 text-center">
						<span class="text-danger">Ne</span>
					</div>
					
					<div class="col-xs-3 text-center ">
						<a href="articles_manage_create.html" class="btn btn-sm btn-success btn-icon"><i class="fa fa-edit"></i></a>
						<button href="#" class="btn btn-sm btn-success btn-icon" data-toggle="modal"  data-target="#Confirm"><i class="fa fa-trash"></i></button>
					</div>
				
				
				</div>
			</li>
		
		</ul>
	</div>
@stop