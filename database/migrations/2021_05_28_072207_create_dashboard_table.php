<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDashboardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dashboard', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('titulo', 65535)->nullable();
			$table->text('grafico', 65535)->nullable();
			$table->text('link de investigacion', 65535)->nullable();
			$table->text('hashtags', 65535)->nullable();
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
		Schema::drop('dashboard');
	}

}
