<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('url', 65535);
			$table->text('title', 65535);
			$table->text('description', 65535)->nullable();
			$table->text('tags', 65535);
			$table->text('status', 65535);
			$table->string('image')->nullable();
			$table->string('thumbnail')->nullable();
			$table->date('date');
			$table->timestamps();
			$table->text('content_without_html_tags', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news');
	}

}
