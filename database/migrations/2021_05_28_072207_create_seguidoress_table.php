<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeguidoressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seguidoress', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('siguiendo_id')->unsigned();
			$table->timestamps();
			$table->primary(['user_id','siguiendo_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seguidoress');
	}

}
