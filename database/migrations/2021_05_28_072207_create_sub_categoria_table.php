<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubCategoriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_categoria', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('categoria_id')->index('fk_sub_categoria_categoria1_idx');
			$table->string('nombre_subcategoria', 100);
			$table->enum('activo', array('0','1'))->default('1');
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
		Schema::drop('sub_categoria');
	}

}
