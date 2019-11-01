<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCasoBitacorasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caso_bitacoras', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('caso_id')->index('fk_caso_bitacoras_casos1_idx');
			$table->integer('caso_estado_id')->index('fk_caso_bitacoras_caso_estados1_idx');
			$table->bigInteger('user_id')->unsigned()->index('fk_caso_bitacoras_users1_idx');
			$table->integer('oficina_id')->index('fk_caso_bitacoras_oficinas1_idx');
			$table->text('comentario', 65535)->nullable();
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
		Schema::drop('caso_bitacoras');
	}

}
