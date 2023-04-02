<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('title', 65535);
			$table->text('description', 65535)->nullable();
			$table->text('tags', 65535);
			$table->smallInteger('type');
			$table->text('template', 65535);
			$table->boolean('status')->default(1);
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
		Schema::drop('charts');
	}

}
