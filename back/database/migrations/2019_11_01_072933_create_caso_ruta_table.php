<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCasoRutaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caso_ruta', function(Blueprint $table)
		{
			$table->integer('caso_id')->index('fk_casos_has_oficinas_casos1_idx');
			$table->integer('oficina_id')->index('fk_casos_has_oficinas_oficinas1_idx');
			$table->integer('orden')->nullable()->default(0);
			$table->primary(['caso_id','oficina_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('caso_ruta');
	}

}
