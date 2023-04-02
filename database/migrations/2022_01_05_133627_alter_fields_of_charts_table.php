<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldsOfChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        Schema::table('charts', function (Blueprint $table) {
            $table->dropColumn('description');
			$table->text('topic');
            $table->text('author_email')->nullable();
            $table->text('author')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charts', function (Blueprint $table) {   
            $table->text('description', 65535)->nullable();
        });
    }
}
