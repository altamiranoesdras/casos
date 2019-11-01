<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOficinasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('oficinas', function(Blueprint $table)
		{
			$table->foreign('empresa_id', 'fk_oficinas_empresas')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('responsable', 'fk_oficinas_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('oficinas', function(Blueprint $table)
		{
			$table->dropForeign('fk_oficinas_empresas');
			$table->dropForeign('fk_oficinas_users1');
		});
	}

}
