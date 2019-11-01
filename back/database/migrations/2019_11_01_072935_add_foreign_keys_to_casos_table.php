<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCasosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('casos', function(Blueprint $table)
		{
			$table->foreign('caso_estado_id', 'fk_casos_caso_estados1')->references('id')->on('caso_estados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('casos', function(Blueprint $table)
		{
			$table->dropForeign('fk_casos_caso_estados1');
		});
	}

}
