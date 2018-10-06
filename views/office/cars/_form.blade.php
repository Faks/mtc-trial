<div class="content">
	@include('office.template.errors')
	
	<form action="{{ $action }}" class="form-horizontal" method="post" enctype="multipart/form-data" style="margin-left: 5%;">
		
		<div class="row">
			<div class="col-md-8">
				<img src="{{ $model->Image ?? false }}" class="img-responsive">
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Izstrādātājs
					</label>
					
					<input type="text" name="Make" value="{{ $model->Make ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Nosaukums
					</label>
					
					<input type="text" name="Name" value="{{ $model->Name ?? false }}" class="form-control border-input">
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Tipāža
					</label>
					
					<input type="text" name="Trim" value="{{ $model->Trim ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Gads
					</label>
					
					<input type="text" name="Year" value="{{ $model->Year ?? false }}" class="form-control border-input">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Uzbūve
					</label>
					
					<input type="text" name="Body" value="{{ $model->Body ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Motorā Pozīcija
					</label>
					
					<input type="text" name="Engine_Position" value="{{ $model->Engine_Position ?? false }}" class="form-control border-input">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Motora Tips
					</label>
					
					<input type="text" name="Engine_Type" value="{{ $model->Engine_Type ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Motorā Kompresija
					</label>
					
					<input type="text" name="Engine_Compression" value="{{ $model->Engine_Compression ?? false }}" class="form-control border-input">
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Motora Degviela
					</label>
					
					<input type="text" name="Engine_Fuel" value="{{ $model->Engine_Fuel ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Motorā Pozīcija
					</label>
					
					<input type="text" name="Engine_Position" value="{{ $model->Engine_Position ?? false }}" class="form-control border-input">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Ražota
					</label>
					
					<input type="text" name="Country" value="{{ $model->Country ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Modelis
					</label>
					
					<input type="text" name="Make_Display" value="{{ $model->Make_Display ?? false }}" class="form-control border-input">
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Svars
					</label>
					
					<input type="text" name="Weight_KG" value="{{ $model->Weight_KG ?? false }}" class="form-control border-input">
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Ātrumkārba
					</label>
					
					<input type="text" name="Transmission_Type" value="{{ $model->Transmission_Type ?? false }}"  class="form-control border-input">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Cena
					</label>
					
					<input type="text" name="Price" value="{{ $model->Price ?? false }}"  class="form-control border-input">
				</div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label for="brand_img" style="display: block;">
						Attēls
					</label>
					
					<div class="fileinput fileinput-new" data-provides="fileinput">
						
						<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 250px;"></div>
						<label style="display: block; visibility: hidden">
							Attēls
						</label>
						
						<div>
							<span class="btn btn-default btn-file"><span class="fileinput-new">Izveleties Bildi</span><span class="fileinput-exists">Nomainit</span><input type="file" name="Image"></span>
							<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Dzest</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="{{ $nameKey }}" value="{{ $name }}">
		<input type="hidden" name="{{ $valueKey }}" value="{{ $value }}">
		
		<div class="row">
			<button name="id" value="{{ $model->id ?? false }}" class="btn btn-default btn-info btn-default" type="submit">Saglabāt</button>
		</div>
		
	</form>
</div>
