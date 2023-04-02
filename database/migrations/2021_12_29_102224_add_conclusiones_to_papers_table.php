<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConclusionesToPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            $table->text('conclusiones_4', 65535)->nullable();
			$table->text('conclusiones_5', 65535)->nullable();
			$table->text('conclusiones_6', 65535)->nullable();
            $table->text('conclusiones_7', 65535)->nullable();
			$table->text('conclusiones_8', 65535)->nullable();
			$table->text('conclusiones_9', 65535)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('papers', function (Blueprint $table) {
            $table->dropColumn('conclusiones_4');
			$table->dropColumn('conclusiones_5');
			$table->dropColumn('conclusiones_6');
            $table->dropColumn('conclusiones_7');
			$table->dropColumn('conclusiones_8');
			$table->dropColumn('conclusiones_9');
        });
    }
}
