<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCasoRutaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('caso_ruta', function(Blueprint $table)
		{
			$table->foreign('caso_id', 'fk_casos_has_oficinas_casos1')->references('id')->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('oficina_id', 'fk_casos_has_oficinas_oficinas1')->references('id')->on('oficinas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('caso_ruta', function(Blueprint $table)
		{
			$table->dropForeign('fk_casos_has_oficinas_casos1');
			$table->dropForeign('fk_casos_has_oficinas_oficinas1');
		});
	}

}
