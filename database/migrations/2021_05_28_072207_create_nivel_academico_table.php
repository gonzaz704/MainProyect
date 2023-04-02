<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNivelAcademicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nivel_academico', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('nombre');
			$table->string('descripcion');
			$table->boolean('activo')->default(1);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nivel_academico');
	}

}
