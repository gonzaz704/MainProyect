<?php

use Illuminate\Database\Migrations\Migration;

//Laravel known issue with changing table column type
//https://stackoverflow.com/questions/33140860/laravel-5-1-unknown-database-type-enum-requested

class UpdateAbstractColumnInPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE papers MODIFY abstract LONGTEXT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE papers MODIFY abstract VARCHAR(255)');
    }
}
