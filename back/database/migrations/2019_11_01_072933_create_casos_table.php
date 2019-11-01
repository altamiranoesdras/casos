<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCasosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('casos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('caso_estado_id')->index('fk_casos_caso_estados1_idx');
			$table->string('titulo');
			$table->text('cuerpo', 65535);
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
		Schema::drop('casos');
	}

}
