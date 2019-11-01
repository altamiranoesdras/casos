<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOficinasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oficinas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('empresa_id')->index('fk_oficinas_empresas_idx');
			$table->string('nombre');
			$table->char('telefono', 25)->nullable();
			$table->string('correo')->nullable();
			$table->bigInteger('responsable')->nullable()->unsigned()->index('fk_oficinas_users1_idx');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('oficinas');
	}

}
