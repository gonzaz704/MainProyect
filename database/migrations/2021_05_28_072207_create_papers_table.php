<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePapersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('papers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('creado_por_id')->nullable()->index('fk_papers_usuarios1_idx');
			$table->integer('sub_categoria_id')->nullable()->index('fk_papers_sub_categoria1_idx');
			$table->integer('categoria_id')->nullable()->index('fk_papers_categoria1_idx');
			$table->text('titulo', 65535)->nullable();
			$table->string('tags')->nullable();
			$table->string('abstract')->nullable();
			$table->text('conclusiones_1', 65535)->nullable();
			$table->text('conclusiones_2', 65535)->nullable();
			$table->text('conclusiones_3', 65535)->nullable();
			$table->text('ruta_grafico', 65535)->nullable();
			$table->text('link_investigacion', 65535)->nullable();
			$table->text('hashtags', 65535)->nullable();
			$table->enum('activo', array('0','1'))->nullable()->default('1');
			$table->string('country')->nullable();
			$table->string('topic')->nullable();
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
		Schema::drop('papers');
	}

}
