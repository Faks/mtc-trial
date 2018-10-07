<?php
	
	use src\Migration\Migration;
	use Illuminate\Database\Schema\Blueprint;
	
	class CarsMigration extends Migration
	{
		public function up()
		{
			$this->schema->create('cars', function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('Make')->nullable();
				$table->string('Name')->nullable();
				$table->string('Trim')->nullable();
				$table->string('Year')->nullable();
				$table->string('Body')->nullable();
				$table->string('Engine_Position')->nullable();
				$table->string('Engine_Type')->nullable();
				$table->string('Engine_Compression')->nullable();
				$table->string('Engine_Fuel')->nullable();
				$table->string('Image')->nullable();
				$table->string('Country')->nullable();
				$table->string('Make_Display')->nullable();
				$table->string('Weight_KG')->nullable();
				$table->string('Transmission_Type')->nullable();
				$table->string('Tags')->nullable();
				$table->string('Price')->nullable();
				$table->enum('Is_API', array('yes' , 'no'))->default('no');
				$table->timestamp('created_at')->nullable();
				$table->timestamp('updated_at')->nullable();
			});
		}
		
		public function down()
		{
			$this->schema->dropIfExists('cars');
		}
	}