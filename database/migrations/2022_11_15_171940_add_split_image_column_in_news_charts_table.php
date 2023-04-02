<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSplitImageColumnInNewsChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_charts', function (Blueprint $table) {
            $table->longText('split_image')->nullable()->after('chart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_charts', function (Blueprint $table) {
            $table->dropColumn(['split_image']);
        });
    }
}
