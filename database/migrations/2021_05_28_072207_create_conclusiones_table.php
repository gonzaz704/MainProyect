<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConclusionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conclusiones', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->integer('papers_id')->index('fk_conclusiones_papers1_idx');
			$table->text('conclusion', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conclusiones');
	}

}
