<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCasoBitacorasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('caso_bitacoras', function(Blueprint $table)
		{
			$table->foreign('caso_estado_id', 'fk_caso_bitacoras_caso_estados1')->references('id')->on('caso_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('caso_id', 'fk_caso_bitacoras_casos1')->references('id')->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('oficina_id', 'fk_caso_bitacoras_oficinas1')->references('id')->on('oficinas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_caso_bitacoras_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('caso_bitacoras', function(Blueprint $table)
		{
			$table->dropForeign('fk_caso_bitacoras_caso_estados1');
			$table->dropForeign('fk_caso_bitacoras_casos1');
			$table->dropForeign('fk_caso_bitacoras_oficinas1');
			$table->dropForeign('fk_caso_bitacoras_users1');
		});
	}

}
